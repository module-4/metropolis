<x-dashboard-layout>
    <x-card>
        <div class="flex flex-justify-center">
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-2xl font-semibold mb-6">Edit Component</h1>

                {{-- Component Edit Form --}}
                <form action="{{ route('components.update', [$simComponent]) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    @method('PATCH')
                    {{-- form fields --}}

                    {{-- Component Name Field --}}
                    <div>
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
                        <x-label for="effect_id">Effect</x-label>
                        <div class="mb-2 flex flex-col gap-2">
                            @foreach ($compEffects as $compEffect)
                                <div class="flex gap-2">
                                    <x-select name="effect_id" id="effect_id">
                                        @foreach ($effects as $effect)
                                                <option value="{{ $effect->id }}"
                                                    {{ old('effect_id', $simComponent->effect_id) == $effect->id ? "selected" : '' }}>
                                                    {{ $effect->name }}
                                                </option>
                                        @endforeach
                                    </x-select>
                                    <x-input
                                        type="text"
                                        name="effect_value"
                                        placeholder="Effect Value"
                                        value="{{ old('effect_value', $simComponent->effect_value) }}"
                                        required
                                    />
                                </div>
                            @endforeach
                                <div id="edit-effect-container">
                                    <div id="effect-row-template" class="flex gap-2" hidden>
                                        <x-select required>
                                            @foreach ($effects as $effect)
                                                <option value="{{ $effect->id }}">{{ $effect->name }}</option>
                                            @endforeach
                                        </x-select>
                                        <x-input type="text" placeholder="Effect Value" name="test" required />
                                    </div>
                                </div>
                                @error('effect_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="mb-6">
                            <x-button id="add-edit-effect">add effect</x-button>
                        </div>
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
        </div>
    </x-card>
</x-dashboard-layout>
