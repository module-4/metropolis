<x-dashboard-layout>
    @vite('resources/js/component-form.js')
    <script> const effectsList = @json($effects); </script>

    <div class="flex items-center justify-center grow max-h-full">
        <x-card class="min-h-[95%] w-[95%] overflow-hidden flex flex-col">
            <div class="container mx-auto px-6 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold">Component Manager</h1>
                    <x-button id="openComponentForm">New Component</x-button>
                </div>
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

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-7 gap-6">
                    @foreach ($components as $simComponent)
                        <div class="bg-white shadow rounded-lg p-4 relative flex flex-col items-center justify-between text-center h-full">
                            <img src="{{ $simComponent->image_name }}" alt="{{ $simComponent->name }}"
                                 class="w-[150px] h-[150px] object-cover rounded mb-3 mx-auto">

                            <h2 class="text-lg font-semibold">{{ $simComponent->name }}</h2>
                            <p class="text-sm text-gray-600 mb-3">Category: {{ $simComponent->category->name ?? 'N/A' }}</p>

                            <x-button isLink href="/components-manager/{{ $simComponent->id }}/edit" variant="primary">
                                Edit
                            </x-button>

                            <!-- Edit Modal -->
                            <dialog id="editModal-{{ $simComponent->id }}" class="rounded-lg p-6">
                                <form action="{{ route('components.update', $simComponent->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <h3 class="text-xl font-bold mb-4">Edit Component</h3>

                                    <div class="mb-4">
                                        <label class="block font-medium">Name</label>
                                        <input name="name" type="text" value="{{ $simComponent->name }}"
                                               class="w-full border px-3 py-2 rounded">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block font-medium">Image URL</label>
                                        <input name="image_url" type="text" value="{{ $simComponent->image_name }}"
                                               class="w-full border px-3 py-2 rounded">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block font-medium">Category</label>
                                        <select name="category_id" class="w-full border px-3 py-2 rounded">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $simComponent->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block font-medium">Effect</label>
                                        <select name="effect_id" class="w-full border px-3 py-2 rounded">
                                            @foreach ($effects as $effect)
                                                <option value="{{ $effect->id }}"
                                                    {{ optional($simComponent->effects->first())->id == $effect->id ? 'selected' : '' }}>
                                                    {{ $effect->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="flex justify-end gap-3 mt-6">
                                        <div class="flex justify-end gap-2 mt-4">
                                            <x-button id="openComponentForm">New Component</x-button>
                                            <x-button type="submit">
                                                Save
                                            </x-button>
                                        </div>
                                    </div>
                                </form>
                            </dialog>
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
                        <x-input type="text" placeholder="Effect Value" required />
                    </div>
                    <form id="newComponentForm" method="POST" action="{{ route('component-store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-4">
                        @csrf
                        <h2 class="text-xl font-bold mb-4">Make new component</h2>

                        <div class="flex flex-col gap-2">
                            <div>
                                <x-label for="Name" >Name:</x-label>
                                <x-input type="text" id="name" name="name" />
                            </div>

                            <div>
                                <x-label for="image">Image:</x-label>
                                <x-input type="file" id="image" name="image" accept="image/*" />
                            </div>

                            <div>
                                <x-label for="category">Category:</x-label>
                                <x-select id="category" name="category">
                                    <option>-</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div id="effects-container">
                            </div>
                            <x-button id="add-effect">
                                Add effect
                            </x-button>
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <x-button id="closeComponentForm" variant="danger" type="button">
                                Cancel
                            </x-button>
                            <x-button id="componentSubmit" variant="primary" type="submit">
                                Add
                            </x-button>

                        </div>
                    </form>
                </div>
            </div>

        </x-card>
    </div>

</x-dashboard-layout>
