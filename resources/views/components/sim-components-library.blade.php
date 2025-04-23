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
    @foreach($componentGroups as $group)
        <x-sim-component-group>
            @if ($group['category'])
                <x-sim-component-category>{{ $group['category'] }}</x-sim-component-category>
            @endif
            @foreach($group['components'] as $componentName)
                <x-sim-component>{{ $componentName }}</x-sim-component>
            @endforeach
            @unless($group['components'] || count($group['components']) > 0)
                <p>Geen componenten gevonden.</p>
            @endunless
        </x-sim-component-group>
    @endforeach
    @unless($componentGroups || count($componentGroups) > 0)
        <p>Geen componenten & categories gevonden.</p>
    @endunless
</div>
