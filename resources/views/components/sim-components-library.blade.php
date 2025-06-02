@props([
    'categories' => []
])

<div class="
    flex
    flex-col

    rounded-md
    p-4
    bg-gray-100
    col-span-1
    gap-2

    min-lg:col-start-4
    min-lg:col-span-2

    max-h-[600px]

    self-start
    border
    border-gray-200
    sim-component-library
">
    <div>
        <h2 class="text-black font-bold text-xl pb-2">
            Component library
        </h2>
        @if (count($categories) > 0)
            <x-input type="search" name="component-search" id="component-search" placeholder="Type to search..." class="bg-white" />
        @endif
    </div>

    <div class="flex flex-col gap-1 overflow-y-auto rounded-md {{ count($categories) > 0 ? 'mt-2' : '' }}">
        @forelse($categories as $category)
            <x-sim-component-group :category="$category">
                @forelse($category->components as $gridComponent)
                    <x-sim-component :id="$gridComponent->id">
                        <img src="{{$gridComponent->image_name}}" alt="{{$gridComponent->name}}" class="pointer-events-none max-w-12 rounded-sm"/>
                        <p>{{ $gridComponent->name }}</p>
                    </x-sim-component>
                @empty
                    <p>No components have been added to this category.</p>
                @endforelse
            </x-sim-component-group>
        @empty
            <p>No components and categories found.</p>
        @endforelse
    </div>

</div>
