<x-dashboard-layout>
    <p>Event management INDEX</p>
    @foreach($events as $event)
        <p>{{$event->name}}</p>
    @endforeach
</x-dashboard-layout>

