@props([
    'effects' => []
])

<div class="
    flex
    flex-col

    rounded-md
    p-4
    bg-gray-100
    gap-0.5

    w-full

    overflow-y-auto
    max-h-[400px]
    self-start
    border
    border-gray-200
">
    <div>
        <h2 class="text-black font-bold text-xl pb-2">
            Simulation effects
        </h2>
    </div>

    <div class="flex flex-col gap-1" id="sim-effects-list">
        @foreach($effects as $key => $value)
            <x-sim-effect id="{{$key}}">{{ $key }}: {{ $value }}</x-sim-effect>
        @endforeach
    </div>
    <p {{ count($effects) > 1 ? 'hidden aria-hidden' : '' }} id="effects-empty-state" class="text-sm text-neutral-700 italic">
        No effects found.
    </p>
</div>
