<x-dashboard-layout>
    <x-card>
        <div class="container mx-auto px-6 py-8">
            <h1 class="text-2xl font-semibold mb-6">Edit Component</h1>

            {{-- Component Edit Form --}}
            <form action="{{ route('components.update', [$simComponent]) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                @method('PATCH')
                {{-- form fields --}}

                {{-- Component Name Field --}}
                <div class="mb-4">
                    <x-label for="name">Component Name</x-label>
                    <x-input
                        type="text" name="name" id="name"
                        value="{{ old('name', $simComponent->name) }}"
                    />
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image URL Field --}}
                <div class="mb-4">
                    <x-label for="image_url">Image</x-label>
                    <x-input
                        type="file" name="image_url" id="image_url"
                        value="{{ old('image_url', $simComponent->image_url) }}"
                    />
                    @error('image_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category Dropdown --}}
                <div class="mb-4">
                    <x-label for="category_id">Category</x-label>
                    <x-select name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $simComponent->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-select>
                    @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Effect Dropdown --}}
                <div class="mb-6">
                    <x-label for="effect_id">Effect</x-label>
                    <x-select name="effect_id" id="effect_id">
                        @foreach ($effects as $effect)
                            <option value="{{ $effect->id }}"
                                {{ old('effect_id', $simComponent->effect_id) == $effect->id ? 'selected' : '' }}>
                                {{ $effect->name }}
                            </option>
                        @endforeach
                    </x-select>
                    @error('effect_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="flex items-center justify-between">
                    <x-button id="closeComponenteditForm" variant="danger" type="button">
                        Cancel
                    </x-button>
                    <x-button variant="primary" type="submit">
                        Edit
                    </x-button>
                </div>
            </form>
        </div>
    </x-card>
</x-dashboard-layout>
