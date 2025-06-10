<div {{$attributes->class("flex gap-4 items-end")}}>
    <div >
        <x-label for="events-select">Event</x-label>
        <x-select required name="events-select" id="events-select">
            @if($events)
                @foreach ($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            @else
                <option disabled>No events found</option>
            @endif
        </x-select>
    </div>
    <div>
        <x-label for="duration">
            Duration
        </x-label>
        <x-input type="number" name="duration" id="duration" value="0"></x-input>
    </div>
    <div class="flex flex-col ">
        <x-label for="itterating">
            Itterating
        </x-label>
        <input hidden class="hidden peer" type="checkbox" name="itterating" id="itterating"
        />
        <label for="itterating"
               class="h-9  aspect-square w-fit border-input border rounded-md hidden peer-checked:flex">
            <x-tabler-check class="m-auto text-bg-foreground"></x-tabler-check>
        </label>
        <label for="itterating"
               class="h-9  aspect-square w-fit border-input border rounded-md flex peer-checked:hidden ">
        </label>
    </div>
    <x-button>
        <x-tabler-player-play></x-tabler-player-play>
    </x-button>
    <x-button>
        <x-tabler-player-pause></x-tabler-player-pause>
    </x-button>
    <x-button>
        <x-tabler-player-stop></x-tabler-player-stop>
    </x-button>
    <div class="w-full h-9 px-3 border border-input rounded-md flex items-center">
        <div class="h-3 w-full bg-bg-300 relative rounded-md overflow-hidden" >
            <div class="absolute left-0 top-0 h-full w-[10%] bg-primary"></div>
        </div>
    </div>
</div>
