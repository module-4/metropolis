<x-dashboard-layout>
    @vite('resources/js/component-form.js')

    <div class="flex items-center justify-center grow max-h-full">
        <x-card class="min-h-[95%] w-[95%] overflow-hidden flex flex-col">
            <button id="openComponentForm" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 mt-4">New Component</button>
            <div id="formModal"
                 class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">

                <form id="newComponentForm" method="POST" action="{{ route('component-store') }}" class="bg-white shadow-md rounded-lg p-6 space-y-4">
                    @csrf
                    <h2 class="text-xl font-bold mb-4">Make new component</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="Name" class="block font-medium">Name:</label>
                            <input type="text" id="name" name="name" class="w-full border rounded px-3 py-2 mt-1" />
                        </div>

                        <div>
                            <label for="image" class="block font-medium">Image (link):</label>
                            <input type="url" id="image" name="image" class="w-full border rounded px-3 py-2 mt-1" />
                        </div>

                        <div>
                            <label for="category" class="block font-medium">Category:</label>
                            <select id="category" name="category" class="w-full border rounded px-3 py-2 mt-1">
                                <option>-</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="effects" class="block font-medium">Effect:</label>
                            <select id="effect" name="effect" class="w-full border rounded px-3 py-2 mt-1">
                                <option>-</option>
                                @foreach($effects as $effect)
                                    <option value="{{ $effect->id }}">{{ $effect->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-between mt-4">
                        <button id="closeComponentForm" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            Cancel
                        </button>
                        <button id="componentSubmit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Add
                        </button>

                    </div>
                </form>
            </div>
        </x-card>
    </div>
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-6">Component Manager</h1>
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

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($components as $simComponent)
                <div class="bg-white shadow rounded-lg p-4 relative">
                    <img src="{{ $simComponent->image_name }}" alt="{{ $simComponent->name }}"
                         class="w-full h-48 object-cover rounded mb-3">

                    <h2 class="text-lg font-semibold">{{ $simComponent->name }}</h2>
                    <p class="text-sm text-gray-600 mb-3">Category: {{ $simComponent->category->name ?? 'N/A' }}</p>

                    <button onclick="document.getElementById('editModal-{{ $simComponent->id }}').showModal()"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Edit
                    </button>

                    <!-- Edit Modal -->
                    <dialog id="editModal-{{ $simComponent->id }}" class="rounded-lg p-6">
                        <form method="POST" action="{{ route('components.update', $simComponent->id) }}">
                            @csrf
                            @method('PUT')

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
                                <button type="button"
                                        onclick="document.getElementById('editModal-{{ $simComponent->id }}').close()"
                                        class="bg-gray-300 px-4 py-2 rounded">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                    Save
                                </button>
                            </div>
                        </form>
                    </dialog>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>
