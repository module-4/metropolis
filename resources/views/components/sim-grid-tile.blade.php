@props([
    'x' => 0,
    'y' => 0
])

<div
    data-x="{{ $x }}"
    data-y="{{ $y }}"
    class="
        bg-gray-200
        text-white
        font-bold
        text-sm
        max-lg:min-h-[100px]
        flex
        justify-center
        items-center
        rounded-md
        border
        border-gray-300
        sim-grid-tile
    ">
    <span class="sr-only">Simulation grid tile located at x{{ $x }}, and y{{ $y }}.</span>
    <div aria-hidden="true" class="absolute top-1 left-1 text-shadow-2xs bg-accent/70 text-accent-foreground text-xs py-0.5 px-1 shadow border border-border rounded-md z-10">
        {{ $x }}, {{ $y }}
    </div>
    {{ $slot }}
</div>
