<x-dashboard-layout>
    <div class="flex grow max-h-full">
        <x-card class="m-6 w-full">
            <x-slot:title>
                Edit component
            </x-slot:title>
            {{-- Component Edit Form --}}
            <form action="{{ route('components.update', [$simComponent]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                {{-- form fields --}}

                {{-- Component Name Field --}}
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <x-label for="name">Component Name</x-label>
                        <x-input
                            type="text" name="name" id="name"
                            value="{{ old('name', $simComponent->name) }}"
                            required
                        />
                        <x-input-error :messages="$errors->get('name')"/>
                    </div>

                    {{-- Image Field --}}
                    <div class="flex flex-col gap-2">
                        <x-label for="image">Image</x-label>
                        <div class="flex">
                            <x-input
                                type="file" name="image" id="image"
                            />
                            @if ($simComponent->image_name)
                                <img src="{{ $simComponent->image_name }}" alt="Image for '{{ $simComponent->name }}' component"
                                     class="max-h-40 block">
                            @endif
                        </div>
                        <x-input-error :messages="$errors->get('image')"/>
                    </div>

                    {{-- Category Dropdown --}}
                    <div class="flex flex-col gap-2">
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
                <div class="flex items-center justify-end gap-1 mt-4">
                    <x-button :isLink="true" href="{{ route('component-manager') }}" variant="danger">
                        Discard changes
                        <x-tabler-trash aria-hidden="true" class="-mr-1"/>
                    </x-button>
                    <x-button variant="success" type="submit">
                        Save changes
                        <x-tabler-check aria-hidden="true" class="-mr-1"/>
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-dashboard-layout>
