<x-dashboard-layout>
    <x-card class="m-4 w-2xl h-fit" >
        <x-slot name="title">
            Create event
        </x-slot>
        <form action="{{ route('events.store') }}" method="POST" class="w-full">
            @csrf
            <div class="mb-4">
                <x-label for="name">Event Name</x-label>
                <x-input
                    type="text" name="name" id="name"
                    value="{{ old('name') }}"
                    required
                />
                <x-input-error :messages="$errors->get('name')"/>
            </div>
            @foreach($effects as $index => $effect)
                <div class="mb-4">
                    <input type="hidden" name="effects[{{ $index }}][id]" value="{{ $effect->id }}">
                    <x-label for="effect-{{$effect->id}}">{{ $effect->name }}</x-label>
                    <x-input
                        type="number"
                        name="effects[{{ $index }}][value]"
                        id="effects-{{$effect->id}}"
                        value="{{ old('effects.'.$index.'.value', 0) }}"
                        step="0.01"
                        required
                    />
                    <x-input-error :messages="$errors->get('effects.' . $effect->id)"/>
                </div>
            @endforeach
            <x-button variant="primary" type="submit">
                Create
            </x-button>
        </form>
    </x-card>
</x-dashboard-layout>
