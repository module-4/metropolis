<?php

namespace App\Http\Controllers;

use App\Models\Effect;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function index() {
        $events = Event::with(['effects'])->get();

        return view('events.index', compact('events'));
    }

    function create() {
        $effects = Effect::all();
        return view('events.create', compact('effects'));
    }


    function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:events,name',
            'effects' => 'required|array',
            'effects.*.id' => 'required|exists:effects,id|distinct',
            'effects.*.value' => 'required|numeric',
        ]);

        $event = Event::create([
            'name' => $request->name,  #<-check the name value in the form
        ]);

        $effectsData = [];
        foreach ($validated['effects'] as $effect) {
            $effectsData[$effect['id']] = ['value' => $effect['value']];
        }

        $event->effects()->attach($effectsData);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    function edit(Event $event) {
        $effects = Effect::all();
        return view('events.edit', compact('event', 'effects'));
    }

    function update(Request $request, Event $event) {

        $validated = $request->validate([
            'name' => 'required|max:255|unique:events,name,' . $event->id,
            'effects' => 'required|array',
            'effects.*.id' => 'required|exists:effects,id|distinct',
            'effects.*.value' => 'required|numeric',
        ]);

        $event->update([
            'name' => $request->name,  #<-check the name value in the form
        ]);

        $effectsData = [];
        foreach ($validated['effects'] as $effect) {
            $effectsData[$effect['id']] = ['value' => $effect['value']];
        }

        $event->effects()->sync($effectsData);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
