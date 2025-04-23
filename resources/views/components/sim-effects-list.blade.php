@props([
    'effects' => []
])

<div class="
    flex
    flex-col

    rounded-md
    p-1.5
    bg-gray-100
    col-span-1
    gap-0.5

    min-lg:col-span-2

    overflow-y-auto
    max-h-[400px]

    self-start
    border
    border-gray-200
">
    @foreach($effects as $effect)
        <x-sim-effect>{{ $effect }}</x-sim-effect>
    @endforeach
    @unless($effects || count($effects) > 0)
        <p>Geen effecten gevonden.</p>
    @endunless
</div>
