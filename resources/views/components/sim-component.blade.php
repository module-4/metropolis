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
    flex
    items-center
    gap-2
    text-center

    transition-shadow duration-200 ease

    cursor-grab
    hover:shadow-md
    sim-component
">
    {{ $slot }}
</div>
