<x-dashboard-layout>
    <div class="flex grow max-h-full">
        <x-card class="m-6 w-full">
            <x-slot:title>
                Component Manager
            </x-slot:title>
            <x-slot:buttons>
                <x-button id="openComponentForm">
                    New component
                    <x-tabler-plus aria-hidden="true" class="-mr-1"/>
                </x-button>
            </x-slot:buttons>
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4 ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div
                class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-7 gap-4">
                @foreach ($components as $simComponent)
                    <div
                        class="w-full bg-gray-50 border border-border rounded-lg p-4 relative flex flex-col items-center justify-between text-center h-full">
                        <div
                            class="w-full bg-white aspect-square border border-border rounded mb-3 mx-auto">
                            <img src="{{ $simComponent->image_name }}" alt="{{ $simComponent->name }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <h2 class="text-lg font-semibold">{{ $simComponent->name }}</h2>
                        <p class="text-sm text-gray-600 mb-3">
                            Category: {{ $simComponent->category->name ?? 'N/A' }}</p>

                        <div class="flex flex-col gap-1">
                            <x-button isLink href="/components-manager/{{ $simComponent->id }}/edit"
                                      variant="primary">
                                Edit component
                                <x-tabler-pencil aria-hidden="true" class="-mr-1"/>
                            </x-button>
                            <form method="post" action="{{ route('components.destroy', $simComponent) }}">
                                @method('DELETE')
                                @csrf
                                <x-button variant="danger">
                                    Delete component
                                    <x-tabler-trash aria-hidden="true" class="-mr-1"/>
                                </x-button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="formModal"
                 class="fixed inset-0 bg-black/10 flex items-center justify-center z-50 hidden">
                <div id="effect-row-template" class="flex gap-2" hidden>
                    <x-select required>
                        @foreach ($effects as $effect)
                            <option value="{{ $effect->id }}">{{ $effect->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input type="text" placeholder="Effect Value" required/>
                </div>
                <form id="newComponentForm" method="POST" action="{{ route('component-store') }}"
                      enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-4">
                    @csrf
                    <h2 class="text-xl font-bold mb-4">Make new component</h2>

                    <div class="flex flex-col gap-2">
                        <div>
                            <x-label for="name">Name:</x-label>
                            <x-input type="text" id="name" name="name"/>
                            <x-input-error :messages="$errors->get('name')"/>
                        </div>

                        <div>
                            <x-label for="image">Image:</x-label>
                            <x-input type="file" id="image" name="image" accept="image/*"/>
                            <x-input-error :messages="$errors->get('image')"/>

                        </div>

                        <div>
                            <x-label for="category">Category:</x-label>
                            <x-select id="category" name="category">
                                <option>-</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('category')"/>
                        </div>
                        <div id="effects-container" class="flex flex-col gap-2 mt-4">
                            @foreach($effects as $id => $effect)
                            <div class="flex gap-4 items-center justify-between">
                                <span class="sr-only">Editing {{ $effect->name }}</span>
                                <x-input type="hidden" name="effects[{{ $id }}][id]" value="{{ $effect->id }}" />
                                <label class="block" for="effects[{{ $id }}][value]">{{ $effect->name }}</label>
                                <x-input type="number" class="w-min" name="effects[{{ $id }}][value]" value="" placeholder="Effect value" aria-label="Enter value for '{{ $effect->name }}' effect"/>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <x-button id="closeComponentForm" variant="danger" type="button">
                            Discard changes
                            <x-tabler-trash aria-hidden="true" class="-mr-1"/>
                        </x-button>
                        <x-button id="componentSubmit" variant="success" type="submit">
                            Save changes
                            <x-tabler-check aria-hidden="true" class="-mr-1"/>
                        </x-button>
                    </div>
                </form>
            </div>
        </x-card>
    </div>
</x-dashboard-layout>
