<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage; 
use App\Models\State;
use App\Models\City;

class EventController extends Controller
{
    public function index(){
        //$events = EventModule::where('account_id', auth()->id())->get();
        $events = Event::with(['state', 'city'])->get(); 
        return view('events.index', compact('events'));
    }

    public function create(){
    
        // Fetch states only for Malaysia (country_id = 132)
        $states = State::Malaysia()->get();
        // Return the create view with the states variable
        return view('events.create', compact('states'));

    }

    public function store(Request $request){
        // Validate the input data
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'date' => 'required|date',
            'type' => 'required',
            'desc' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg', 
            'state_id' => 'required|exists:states,id', // Validate that the state exists in the states table
            'city_id' => 'required|exists:cities,id',// Validate that the city exists in the cities table
        ]);

        $state = State::find($request->state_id);
        $city = City::find($request->city_id);

        // Add state_name and city_name to the data array
        $data['state_name'] = $state ? $state->name : null;
        $data['city_name'] = $city ? $city->name : null;

        // Handle file upload for the poster
        if ($request->hasFile('poster')) {
            $fileName = time() . '_' . $request->poster->getClientOriginalName();
            $filePath = $request->file('poster')->storeAs('posters', $fileName, 'public');
            $data['poster'] = '/storage/posters/' . $fileName;
        }

        // Create the event record
        $newEvent = Event::create($data);

        $data['account_id'] = Auth::id();

        if ($newEvent) {
            ActivityLog::create([
                'account_id' => Auth::id(),
                'activityType' => 'Tambah',
                'activityDetails' => 'tambah program baru: ' . $data['name'],
            ]);
    
            return redirect(route('events.index'))->with('success', 'Program Telah Berjaya Ditambah!');
        }
    
        return redirect(route('events.index'))->with('error', 'Program Tidak Berjaya Ditambah.');
    }

        public function getStatesAndCities()
        {
            // Fetch all states for Malaysia
            $states = State::malaysia()->with('cities')->get();
            return response()->json($states);
        }

        public function getCities($stateId)
        {
            // Fetch all cities for the selected state
            $cities = City::where('state_id', $stateId)->get();
            return response()->json(['cities' => $cities]);
        }

    

    public function edit(Event $event){
        // Get states for Malaysia
        $states = State::Malaysia()->get();

        // Get cities based on the event's state
        $cities = City::where('state_id', $event->state_id)->get();
        
        //return view('events.edit', compact('event', 'states', 'cities'));
        return view('events.edit', compact('event', 'states', 'cities'));
    }

    public function update(Event $event, Request $request){
        // Validate the input data
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'date' => 'required|date',
            'type' => 'required',
            'desc' => 'required|string',
            'poster' => 'nullableimage|mimes:jpeg,png,jpg',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
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
        if ($event->update($data)) {
            ActivityLog::create([
                'account_id' => Auth::id(),
                'activityType' => 'Kemaskini',
                'activityDetails' => 'kemaskini maklumat program: ' . $data['name'],
            ]);
    
            return redirect(route('events.index'))->with('success', 'Maklumat Program Telah Berjaya Dikemaskini!');
        }
    
        return redirect(route('events.index'))->with('error', 'Maklumat Program Tidak Berjaya Dikemaskini.');
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

        if ($event->delete()) {
            ActivityLog::create([
                'account_id' => Auth::id(),
                'activityType' => 'Hapus',
                'activityDetails' => 'hapuskan program: ' . $event->name,
            ]);

            return redirect()->route('events.index')->with('success', 'Program Telah Berjaya Dihapuskan!');
        }

        }

        public function show($id)
        {
            $event = Event::find($id);
            $otherEvents = Event::where('id', '!=', $id)->take(5)->get(); // Get other events

            return view('events.detail', compact('event', 'otherEvents'));
        }

        public function showRegisteredEvents()
    {
        // Assuming you have an authenticated user and a relationship between User and Event
        $events = auth()->user()->events;  // Retrieve events the user has registered for

        return view('events.registered', compact('events'));  // Pass events to the view
    }

        public function showEvent($id)
{
    // Retrieve the event by its ID
    $event = Event::find($id);
    
    // Pass the event to the view
    return view('event.show', compact('event'));
}

        
}