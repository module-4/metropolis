@props([
    'componentGroups' => []
])

<div class="
    flex
    flex-col

    rounded-md
    p-1.5
    bg-gray-100
    col-span-1
    gap-0.5

    min-lg:col-start-4
    min-lg:col-span-2

    overflow-y-auto
    max-h-[400px]

    self-start
    border
    border-gray-200
">
    @forelse($componentGroups as $group)
        <x-sim-component-group>
            @if ($group['category'])
                <x-sim-component-category>{{ $group['category'] }}</x-sim-component-category>
            @endif
            @forelse($group['components'] as $componentName)
                <x-sim-component>{{ $componentName }}</x-sim-component>
            @empty
                <p>Geen componenten gevonden.</p>
            @endforelse
        </x-sim-component-group>
    @empty
        <p>Geen componenten & categories gevonden.</p>
    @endforelse
</div>
