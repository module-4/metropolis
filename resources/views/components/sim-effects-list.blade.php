@props([
    'effects' => []
])
<div class="
    border
    border-gray-200
    rounded-md
    p-1.5
    bg-gray-100
    col-span-1
    gap-0.5
    min-lg:col-span-2
    overflow-y-auto
    max-h-[400px]
    ">
    <h2 class="text-lg font-bold mt-2">Effects</h2>
    <div
        id="sim-effects-list"
        class="
        flex
        flex-col
        self-start
        ">
        @forelse($effects as $key => $value)
            <x-sim-effect :id="$key">{{ $key }}: {{ $value }}</x-sim-effect>
        @empty
            <p id="empty-state">No effects found</p>
        @endforelse
    </div>
</div>
