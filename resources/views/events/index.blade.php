<x-dashboard-layout>
    <div class="flex grow max-h-full">
        <x-card class="m-6 w-full">
            <x-slot:title>
                Events
            </x-slot:title>
            <x-slot:buttons>
                <x-button :isLink="true" href="{{ route('events.create') }}">
                    New event
                    <x-tabler-plus aria-hidden="true" class="-mr-1"/>
                </x-button>
            </x-slot:buttons>
            <x-table>
                <x-slot:thead>
                    <x-table-head>Event name</x-table-head>
                    <x-table-head>Effects</x-table-head>
                    <x-table-head>Actions</x-table-head>
                </x-slot:thead>
                @foreach($events as $event)

                    <x-table-row>
                        <x-table-data>{{ $event->name }}</x-table-data>
                        <x-table-data>
                            <ul>
                                @foreach($event->effects as $effect)
                                    <li class="grid grid-cols-2 w-60">
                                    <span
                                        class="font-semibold">{{$effect->name}}:</span><span>{{$effect->pivot->value}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </x-table-data>
                        <x-table-data class="flex h-full justify-end items-center">
                            <div class="flex flex-row gap-2">
                                <x-button isLink href="{{route('events.edit',[$event->id])}}" variant="primary">
                                    Edit event
                                    <x-tabler-pencil aria-hidden="true" class="-mr-2"/>
                                </x-button>
                                <form action="{{route("events.destroy",[$event->id])}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <x-button type="submit" variant="danger">
                                        Delete event
                                        <x-tabler-trash aria-hidden="true" class="-mr-1"/>
                                    </x-button>
                                </form>
                            </div>
                        </x-table-data>
                    </x-table-row>

                @endforeach
            </x-table>
        </x-card>
    </div>
</x-dashboard-layout>

