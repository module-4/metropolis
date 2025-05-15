@props([
    'id' => ''
])

<div draggable="true" id="component-{{bin2hex(random_bytes(8))}}" data-component-id="{{$id}}" class="
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
