@props([
    'src',             // Lordicon CDN url, e.g. https://cdn.lordicon.com/{code}.json
    'fallback',        // Lucide icon name used if the animated icon fails to load
    'size' => 32,
    'trigger' => 'loop', // loop | hover | click | loop-on-hover | morph | boomerang
    'delay' => 2000,
    'colors' => null,   // e.g. "primary:#6b3bec,secondary:#a68af5"
])

<span
    class="animated-icon inline-flex shrink-0 items-center justify-center"
    style="width:{{ $size }}px;height:{{ $size }}px;"
    data-fallback-icon="{{ $fallback }}"
    data-icon-size="{{ $size }}"
>
    <lord-icon
        src="{{ $src }}"
        trigger="{{ $trigger }}"
        delay="{{ $delay }}"
        @if($colors) colors="{{ $colors }}" @endif
        style="width:100%;height:100%;"
    ></lord-icon>
</span>
