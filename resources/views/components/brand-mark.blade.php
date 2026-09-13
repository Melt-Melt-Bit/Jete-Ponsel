@props([
    'href' => route('home'),
    'class' => 'brand-mark',
    'ariaLabel' => 'JT Ponsel home',
])

<a class="{{ $class }}" href="{{ $href }}" aria-label="{{ $ariaLabel }}">
    <span class="brand-icon">
        <svg viewBox="0 0 40 40" aria-hidden="true">
            <path d="M10 4h20a6 6 0 0 1 6 6v20a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V10a6 6 0 0 1 6-6Z" fill="none" stroke="currentColor" stroke-width="3"/>
            <path d="M13 13h14M20 13v14M13 27h14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
        </svg>
    </span>
    <span>JT<span class="brand-dot">.</span></span>
</a>
