<x-dashboard-layout>
    <x-card class="m-4 w-2xl h-fit">
        <x-slot name="title">
            Edit event
        </x-slot>
        <form action="{{ route('events.update',[$event->id]) }}" method="POST" class="w-full">
            @csrf
            @method("PUT")
            <div class="mb-4">
                <x-label for="name">Event Name</x-label>
                <x-input
                    type="text" name="name" id="name"
                    value="{{ old('name',$event->name) }}"
                    required
                    class="mt-2"
                />
                <x-input-error :messages="$errors->get('name')"/>
            </div>
            @foreach($event->effects as $index => $effect)
                <div class="mb-4">
                    <input type="hidden" name="effects[{{ $index }}][id]" value="{{ $effect->id }}">
                    <x-label for="effect-{{$effect->id}}">{{ $effect->name }}</x-label>
                    <x-input
                        type="number"
                        name="effects[{{ $index }}][value]"
                        id="effects-{{$effect->pivot->id}}"
                        value="{{ old('effects.'.$index.'.value',$effect->pivot->value) }}"
                        step="0.01"
                        class="mt-2"
                        required
                    />
                    <x-input-error :messages="$errors->get('effects.' . $effect->id)"/>
                </div>
            @endforeach
            <div class="flex items-center justify-end gap-1 mt-4">
                <x-button :isLink="true" href="{{ route('events.index') }}" variant="danger">
                    Discard changes
                    <x-tabler-trash aria-hidden="true" class="-mr-1"/>
                </x-button>
                <x-button variant="success" type="submit">
                    Save changes
                    <x-tabler-check aria-hidden="true" class="-mr-1" />
                </x-button>
            </div>
        </form>
    </x-card>
</x-dashboard-layout>
