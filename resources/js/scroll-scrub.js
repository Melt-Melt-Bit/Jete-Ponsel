/**
 * Scroll-scrub frame animation.
 *
 * How it works:
 * 1. We preload every frame image (frame_0001.png ... frame_00NN.png).
 * 2. A tall "track" element (e.g. 400vh) defines how much scrolling
 *    equals one full animation. A sticky child stays pinned in the
 *    viewport for the whole track height.
 * 3. On every scroll/rAF tick we work out how far the user has
 *    scrolled through the track (0 to 1) and draw the matching frame
 *    onto a <canvas>. That's the whole trick — it just LOOKS like
 *    video playback, but it's really just very fast image-swapping.
 */
function initScrollScrub({
  trackSelector,
  canvasSelector,
  progressBarSelector,
  framePathPattern, // e.g. "/images/phone-frames/frame_%04d.png"
  frameCount,
  onProgress, // optional callback(progress 0..1)
}) {
  const track = document.querySelector(trackSelector);
  const canvas = document.querySelector(canvasSelector);
  const progressBar = progressBarSelector
    ? document.querySelector(progressBarSelector)
    : null;

  if (!track || !canvas) return;

  const ctx = canvas.getContext("2d");
  const images = new Array(frameCount);
  let loadedCount = 0;
  let firstFrameReady = false;

  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
  ).matches;

  function frameSrc(index) {
    // index is 1-based to match frame_0001.png naming
    const padded = String(index).padStart(4, "0");
    return framePathPattern.replace("%04d", padded);
  }

  function resizeCanvasToDisplaySize() {
    const rect = canvas.getBoundingClientRect();
    const dpr = window.devicePixelRatio || 1;
    const targetW = Math.round(rect.width * dpr);
    const targetH = Math.round(rect.height * dpr);
    if (canvas.width !== targetW || canvas.height !== targetH) {
      canvas.width = targetW;
      canvas.height = targetH;
    }
  }

  function drawFrame(index) {
    const img = images[index - 1];
    if (!img || !img.complete || img.naturalWidth === 0) return;
    resizeCanvasToDisplaySize();
    const cw = canvas.width;
    const ch = canvas.height;
    // contain-fit the image inside the canvas
    const scale = Math.min(cw / img.naturalWidth, ch / img.naturalHeight);
    const w = img.naturalWidth * scale;
    const h = img.naturalHeight * scale;
    const x = (cw - w) / 2;
    const y = (ch - h) / 2;
    ctx.clearRect(0, 0, cw, ch);
    ctx.drawImage(img, x, y, w, h);
  }

  function preloadFrames() {
    for (let i = 1; i <= frameCount; i++) {
      const img = new Image();
      img.decoding = "async";
      img.onload = () => {
        loadedCount++;
        if (!firstFrameReady && i === 1) {
          firstFrameReady = true;
          drawFrame(1);
        }
      };
      img.src = frameSrc(i);
      images[i - 1] = img;
    }
  }

  function currentProgress() {
    const rect = track.getBoundingClientRect();
    const trackHeight = track.offsetHeight - window.innerHeight;
    if (trackHeight <= 0) return 0;
    const scrolled = -rect.top;
    return Math.min(1, Math.max(0, scrolled / trackHeight));
  }

  let ticking = false;

  function onScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      const progress = currentProgress();
      const frameIndex = Math.min(
        frameCount,
        Math.max(1, Math.round(progress * (frameCount - 1)) + 1)
      );
      drawFrame(frameIndex);
      if (progressBar) {
        progressBar.style.width = `${progress * 100}%`;
      }
      if (onProgress) onProgress(progress);
      ticking = false;
    });
  }

  preloadFrames();
  window.addEventListener("resize", () => {
    resizeCanvasToDisplaySize();
    onScroll();
  });

  if (prefersReducedMotion) {
    // Respect the user's OS setting: show a static hero frame instead
    // of tying imagery to scroll position.
    const img = new Image();
    img.onload = () => {
      images[0] = img;
      resizeCanvasToDisplaySize();
      drawFrame(1);
    };
    img.src = frameSrc(1);
    return;
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();
}
document.addEventListener('DOMContentLoaded', () => {
    initScrollScrub({
        trackSelector: '#hero',
        canvasSelector: '#phone-canvas',
        progressBarSelector: '#hero-progress',
        framePathPattern: '/images/phone-frames/frame_%04d.png',
        frameCount: 48,
    });
});