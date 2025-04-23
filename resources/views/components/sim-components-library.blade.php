@props([
    'categories' => []
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
    @forelse($categories as $category)
        <x-sim-component-group>
            @if ($category)
                <x-sim-component-category>{{ $category->name }}</x-sim-component-category>
            @endif
            @forelse($category->components as $components)

                <x-sim-component>{{ $components->name }}</x-sim-component>
            @empty
                <p>Geen componenten gevonden.</p>
            @endforelse
        </x-sim-component-group>
    @empty
        <p>Geen componenten & categories gevonden.</p>
    @endforelse
</div>
