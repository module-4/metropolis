<x-dashboard-layout>
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-semibold mb-6">Edit Component</h1>

        {{-- Component Edit Form --}}
        <form action="{{ route('components.update', $component->id) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PATCH')
            {{-- form fields --}}

            {{-- Component Name Field --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Component Name</label>
                <input
                    type="text" name="name" id="name"
                    value="{{ old('name', $component->name) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image URL Field --}}
            <div class="mb-4">
                <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">Image URL</label>
                <input
                    type="text" name="image_url" id="image_url"
                    value="{{ old('image_url', $component->image_url) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
                @error('image_url')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category Dropdown --}}
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select
                    name="category_id" id="category_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $component->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Effect Dropdown --}}
            <div class="mb-6">
                <label for="effect_id" class="block text-gray-700 text-sm font-bold mb-2">Effect</label>
                <select
                    name="effect_id" id="effect_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
                    @foreach ($effects as $effect)
                        <option value="{{ $effect->id }}"
                            {{ old('effect_id', $component->effect_id) == $effect->id ? 'selected' : '' }}>
                            {{ $effect->name }}
                        </option>
                    @endforeach
                </select>
                @error('effect_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-between">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Update Component
                </button>
            </div>
        </form>

        {{-- Component List --}}
        <h2 class="text-xl font-semibold mt-10 mb-4">All Components</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($components as $item)
                <div class="bg-white p-4 rounded shadow">
                    <img src="{{ $item->image_name }}" alt="{{ $item->name }}" class="w-full h-40 object-cover rounded mb-2">
                    <h3 class="text-lg font-bold">{{ $item->name }}</h3>
                    <p class="text-sm text-gray-600">Category: {{ $item->category->name ?? 'Uncategorized' }}</p>
                    <a href="{{ route('components.edit', $item->id) }}" class="inline-block mt-2 text-blue-600 hover:underline">Edit</a>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>
