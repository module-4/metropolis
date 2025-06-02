@props([
    'x' => 0,
    'y' => 0
])

<div
    data-x="{{$x}}"
    data-y="{{$y}}"
    class="bg-primary text-white font-bold text-sm max-lg:min-h-[100px] flex justify-center items-center sim-grid-tile
">
    <div class="absolute top-2 left-2 text-shadow-2xs bg-black/25 text-xs py-0.5 px-2 rounded-full z-10">
        {{ $x }}, {{ $y }}
    </div>
    {{ $slot }}
</div>
