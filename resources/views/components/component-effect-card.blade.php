<div class="w-full md:w-1/2 px-2 my-2">
    <div class="bg-white shadow-md rounded-lg p-6 max-h-[30vh] overflow-auto">
        <h1 class="text-2xl font-bold mb-4">{{ $simComponent->name }}</h1>
        <x-table>
            <x-slot:thead>
                <x-table-head>Effect name</x-table-head>
                <x-table-head>Effect value</x-table-head>
                <x-table-head>Update</x-table-head>
            </x-slot:thead>
            @foreach($simComponent->effects as $effect)

                    <x-table-row>
                        <x-table-data>{{ $effect->name }}</x-table-data>
                        <x-table-data><form id="form-{{ $effect->name }}" method="POST" action="{{ route('component-effect-management-update', ['componentId' => $simComponent->id, 'effectId' => $effect->id]) }}">
                                @csrf
                                @method('PATCH')
                                <input value="{{ $effect->pivot->value }}" name="effect-value" type="number" class="border rounded px-3 py-2 w-full text-center" min="-100000000" max="100000000"/>
                            </form></x-table-data>
                        <x-table-data><button form="form-{{ $effect->name }}" class="bg-primary hover:bg-primary/90 text-primary-foreground px-4 py-2 rounded">
                                Update
                            </button></x-table-data>

                    </x-table-row>

            @endforeach
        </x-table>
    </div>
</div>
