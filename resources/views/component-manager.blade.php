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
</x-dashboard-layout>
