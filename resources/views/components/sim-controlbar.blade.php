<form id="sim-controlbar-form" {{$attributes->class("flex gap-4 items-end")}}>
    <div>
        <x-label for="event">Event</x-label>
        <x-select required name="event" id="event" value="0" class="min-w-52 mt-2">
            @if($events)
                @foreach ($events as $index => $event)
                    <option @if($index === 0)
                                selected
                            @endif value="{{json_encode($event)}}">{{ $event->name }}</option>
                @endforeach
            @else
                <option disabled>No events found</option>
            @endif
        </x-select>
    </div>
    <div>
        <x-label for="duration">
            Event duration
        </x-label>
        <x-input type="number" name="duration" id="duration" class="mt-2" required min="1" value="1" step="0.1"></x-input>
    </div>
    <div class="flex flex-col ">
        <x-label for="iterating">
            Recurring
        </x-label>
        <input hidden class="hidden peer" type="checkbox" name="iterating" id="iterating"
        />
        <label for="iterating"
               class="h-9 mt-2 aspect-square w-fit border-input border rounded-md hidden peer-checked:flex">
            <x-tabler-check class="m-auto text-bg-foreground"></x-tabler-check>
        </label>
        <label for="iterating"
               class="h-9 mt-2 aspect-square w-fit border-input border rounded-md flex peer-checked:hidden ">
        </label>
    </div>
    <x-button type="submit" id="sim-play" type="submit" name="action" value="play" variant="success" title="Start event simulation playback">
        <span class="sr-only">Start event simulation playback</span>
        <x-tabler-player-play aria-hidden="true"/>
    </x-button>
    <x-button id="sim-stop" type="submit" name="action" value="stop" variant="danger" title="Stop event simulation playback">
        <span class="sr-only">Stop event simulation playback</span>
        <x-tabler-player-stop aria-hidden="true" />
    </x-button>
    <div class="w-full h-9 px-3 border border-input rounded-md flex items-center">
        <div class="h-3 w-full bg-bg-300 relative rounded-md overflow-hidden">
            <div id="sim-event-progress" class="absolute left-0 top-0 h-full w-0 bg-primary"></div>
        </div>
    </div>
</form>
