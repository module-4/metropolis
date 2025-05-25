<x-dashboard-layout>
    <div class="flex items-center justify-center grow max-h-full">
        <x-card  class="min-h-[95%] w-[95%] overflow-hidden flex flex-col">
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-2xl font-semibold mb-6">Edit Component</h1>

                {{-- Component Edit Form --}}
                <form action="{{ route('components.update', [$simComponent]) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
                                required
                            />
                            <x-input-error :messages="$errors->get('name')"/>
                        </div>

                        {{-- Image Field --}}
                        <div class="mb-4">
                            <x-label for="image">Image</x-label>
                            <div class="flex">
                                <x-input
                                    type="file" name="image" id="image"
                                />
                                @if ($simComponent->image_name)
                                    <img src="/{{ $simComponent->image_name }}" alt="component image" class="max-h-40 block">
                                @endif
                            </div>
                            <x-input-error :messages="$errors->get('image')"/>
                        </div>

                        {{-- Category Dropdown --}}
                        <div class="mb-4">
                            <x-label for="category_id">Category</x-label>
                            <x-select name="category_id" id="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @selected(old('category_id', $simComponent->category_id) === $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('category_id')"/>
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
        </x-card>
    </div>
</x-dashboard-layout>
