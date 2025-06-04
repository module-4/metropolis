@props([
    'id' => '',
    'isApproved' => false,
    'inLibrary' => true
])
<div draggable="{{ $inLibrary ? 'true' : ($isApproved ? 'false' : 'true') }}" id="component-{{bin2hex(random_bytes(8))}}" data-component-id="{{$id}}"
     class="
    bg-white
    border
    {{ $inLibrary ? 'border-gray-200' : ($isApproved ? 'border-success border-4' : 'border-gray-200') }}
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

    select-none
    sim-component
">
    {{ $slot }}
</div>
