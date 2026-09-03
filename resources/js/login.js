const track = document.querySelector('[data-auth-track]');
const slides = [...document.querySelectorAll('[data-auth-slide]')];
const switchButtons = [...document.querySelectorAll('[data-switch-auth]')];

if (track && slides.length === 2) {
    const setAuthMode = (mode) => {
        const isSignUp = mode === 'signup';

        track.style.transform = isSignUp ? 'translateX(-50%)' : 'translateX(0)';

        slides.forEach((slide, index) => {
            const isVisible = isSignUp ? index === 1 : index === 0;

            slide.setAttribute('aria-hidden', String(!isVisible));
            slide.querySelectorAll('input, button, a, select, textarea').forEach((element) => {
                element.tabIndex = isVisible ? 0 : -1;
            });
        });
    };

    switchButtons.forEach((button) => {
        button.addEventListener('click', () => {
            setAuthMode(button.dataset.switchAuth);
        });
    });

    setAuthMode('signin');
}
