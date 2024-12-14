<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage; 

class EventController extends Controller
{
    public function index(){
        $events = Event::all();
        return view('events.index', ['events' => $events]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        // Validate the input data
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'date' => 'required|date',
            'type' => 'required',
            'desc' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg' 
        ]);

        // Handle file upload for the poster
        if ($request->hasFile('poster')) {
            $fileName = time() . '_' . $request->poster->getClientOriginalName();
            $filePath = $request->file('poster')->storeAs('posters', $fileName, 'public');
            $data['poster'] = '/storage/posters/' . $fileName;
        }

        // Create the event record
        $newEvent = Event::create($data);
        return redirect(route('events.index'))->with('success', 'Event Created Successfully!');
    }

    public function edit(Event $event){
        return view('events.edit', ['event' => $event]);
    }

    public function update(Event $event, Request $request){
        // Validate the input data
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'date' => 'required|date',
            'type' => 'required',
            'desc' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg' 
        ]);

        // Handle file upload for the poster
        if ($request->hasFile('poster')) {
            $fileName = time() . '_' . $request->poster->getClientOriginalName();
            $filePath = $request->file('poster')->storeAs('posters', $fileName, 'public');
            $data['poster'] = rtrim('/storage/', '/') . '/' . ltrim($filePath, '/');
        } else {
            // Retain the existing poster if no new one is uploaded
            $data['poster'] = $event->poster;
        }

        // Update the event record
        $event->update($data);
        return redirect(route('events.index'))->with('success', 'Event Information Updated Successfully!');
    }

    public function destroy(Event $event){
        // Delete the event
        /* $event->delete();
        return redirect(route('events.index'))->with('success', 'Event Deleted Successfully!');
        */
         // Delete the event poster file if it exists
         if ($event->poster) {
            $posterPath = str_replace('/storage/', '', $event->poster);
            Storage::delete('public/' . $posterPath);
        }  

        // Delete the event record from the database
        $event->delete();

        // Redirect to the deleted event confirmation page
        return redirect(route('events.index'))->with('success', 'Event Deleted Successfully!');

        }

        public function show($id)
        {
            $event = Event::find($id);
            $otherEvents = Event::where('id', '!=', $id)->take(5)->get(); // Get other events

            return view('events.detail', compact('event', 'otherEvents'));
        }
        
}