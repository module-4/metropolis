@props([
    'effects' => []
])

<div id="sim-effects-list" class="
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
    @forelse($effects as $key => $value)
        <x-sim-effect>{{ $key }} {{ $value }}</x-sim-effect>
    @empty
        <p>No effects found.</p>
    @endforelse
</div>
