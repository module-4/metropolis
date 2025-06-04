<x-dashboard-layout>
    <x-card class="m-4 w-full">
        <x-slot name="title" class="flex gap-8 items-center">
            Events
            <x-button isLink href="{{route('events.create')}}">New</x-button>
        </x-slot>
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
                    <x-table-data>
                        <div class="max-w-28 flex flex-row gap-4">
                            <x-button isLink href="{{route('events.edit',[$event->id])}}" class="w-full">
                                Update
                            </x-button>
                            <form action="{{route("events.destroy",[$event->id])}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <x-button type="submit" class="w-full" variant="danger">
                                    Delete
                                </x-button>
                            </form>
                        </div>
                    </x-table-data>
                </x-table-row>

            @endforeach
        </x-table>
    </x-card>
</x-dashboard-layout>

