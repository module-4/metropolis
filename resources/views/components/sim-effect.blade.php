<div {{$attributes}} {{$attributes->class("
    bg-white
    border
    border-gray-200
    px-4
    py-2
    rounded-md
    text-black
    flex
    gap-4
")}}>
    <div class="sim-effect">
        {{ $slot }}
    </div>
    <div class="event-effect">

    </div>
</div>
