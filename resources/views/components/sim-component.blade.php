@props([
    'id' => ''
])

<div draggable="true" id="{{$id}}" class="
    bg-white
    border
    border-gray-200
    p-2
    rounded-md
    text-black
    sim-component
    flex
    items-center
    gap-2
text-center
">
    {{ $slot }}
</div>
