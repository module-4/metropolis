<div class="flex flex-col gap-2">
    <h2 class="text-xl font-bold">{{ $simComponent->name }}</h2>
    <x-table class="h-full">
        <x-slot:thead>
            <x-table-head>Effect name</x-table-head>
            <x-table-head>Effect value</x-table-head>
            <x-table-head>Actions</x-table-head>
        </x-slot:thead>
        @foreach($simComponent->effects as $effect)
            <x-table-row>
                <x-table-data>{{ $effect->name }}</x-table-data>
                <x-table-data>
                    <form id="form-{{ $effect->name }}" method="POST"
                          action="{{ route('component-effect-management-update', ['componentId' => $simComponent->id, 'effectId' => $effect->id]) }}">
                        @csrf
                        @method('PATCH')
                        <x-label for="effect-value-{{ $effect->id }}" class="sr-only">Effect value</x-label>
                        <x-input value="{{ $effect->pivot->value }}" name="effect-value" id="effect-value-{{ $effect->id }}" type="number"
                                 class="bg-white w-full" min="-100000" max="100000"/>
                    </form>
                </x-table-data>
                <x-table-data class="flex h-full justify-end items-center">
                    <x-button tabindex="0" form="form-{{ $effect->name }}" variant="success">
                        Update effect
                        <x-tabler-check aria-hidden="true" class="-mr-1"/>
                    </x-button>
                </x-table-data>

            </x-table-row>
        @endforeach
    </x-table>
</div>
