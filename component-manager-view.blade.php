<x-dashboard-layout>
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
