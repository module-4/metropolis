@props([
    'x' => 0,
    'y' => 0
])

<div
    data-x="{{$x}}"
    data-y="{{$y}}"
    class="bg-primary text-white font-bold text-sm p-2 max-lg:min-h-[100px] flex justify-center items-center sim-grid-tile
">
    {{ $slot }}
</div>
