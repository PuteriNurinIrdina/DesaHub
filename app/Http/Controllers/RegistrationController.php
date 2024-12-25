<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterEvent;
use App\Models\Event;

class RegistrationController extends Controller
{
    /*public function index(Request $request) {
        //$events = Event::all(); 
        $events_id = $request->query('event_id');

        return view('event-registration.index', compact('event_id'));
    }*/

    public function index(Request $request)
    {
        // Retrieve event_id from query parameters
        $event_id = $request->query('event_id');

        if (!$event_id) {
            return redirect()->route('events.view')->with('error', 'Event ID is required.');
        }

        // Example: Retrieve event details using event_id
        $event = Event::find($event_id);
        if (!$event) {
            return redirect()->route('events.view')->with('error', 'Event not found.');
        }

        // Pass event_id to the view
        return view('EventRegistration.index', compact('event', 'event_id'));
    }


    public function store(Request $request)
    {
        \Log::info($request->all());
        // Validate input data including event_id
        $data = $request->validate([
            'ic_num' => 'required|digits:12',
            'name' => 'required|string|max:255',
            'phone_num' => 'required|digits_between:10,11',
            'gender' => 'required|string',
            'address' => 'required|string',
            'poscode' => 'required|digits:5',
            'state' => 'required|string',
            'email' => 'nullable|email',
            'house_category' => 'required|string',
            'age_class' => 'required|string',
            'event_id' => 'required|exists:events,id',  // Ensure event_id exists in the database
        ], [
            'ic_num.required' => 'Sila Isi No Kad Pengenalan Anda.',
            'ic_num.digits' => "No Kad Pengenalan Mestilah Mengandungi 12 Digit Sahaja (tanpa '-')",
            'name.required' => 'Sila Isi Nama Anda.',
            'name.string' => 'Nama Mestilah Dalam Bentuk Teks.',
            'phone_num.required' => 'Sila Isi No Telefon Bimbit Anda.',
            'phone_num.digits_between' => "No Telefon Bimbit Mestilah Di Antara 10 Hingga 11 Digit Sahaja (tanpa '-')",
            'gender.required' => 'Sila Pilih Jantina Anda.',
            'address.required' => 'Sila Isi Alamat Anda.',
            'poscode.required' => 'Sila Isi Poskod Anda.',
            'poscode.digits' => 'Poskod Mestilah 5 Digit Sahaja.',
            'state.required' => 'Sila Pilih Negeri Anda.',
            'email.email' => 'Emel yang Dimasukkan Tidak Mengikut Format yang Sah.',
            'house_category.required' => 'Sila Pilih Isi Kategori Rumah Anda.',
            'age_class.required' => 'Sila Pilih Peringkat Umur Anda.',
            'event_id.required' => 'Event ID is required.',
            'event_id.exists' => 'Event yang Dipilih Tidak Sah. Sila Pilih Event Yang Betul.',
        ]);

        // Optional: Convert name to uppercase (if needed for consistency)
        $data['name'] = strtoupper($data['name']);

        // Store the registration data in the database
        RegisterEvent::create($data);

        // If the request is AJAX, return a JSON response
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pendaftaran Berjaya!',
            ]);
        }

        // Redirect to the success page after registration
        return redirect()->route('events.view')->with('success', 'Berjaya!');
    }



    public function attendees() {
        $attendees = RegisterEvent::where('attendance', 1)->get();
        return view('EventRegistration.attendees', compact('attendees'));
    }

    public function absent(Request $request) {
        $query = RegisterEvent::where('attendance', 0);

        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $nonAttendees = $query->get();
        return view('EventRegistration.absent', compact('nonAttendees'));
    }

    public function showAllRegistrants() {
        $registrants = RegisterEvent::all(); 
        return view('EventRegistration.registrant', compact('registrants'));
    }

    public function showRegistrants(Request $request) {
        $searchQuery = $request->input('searchQuery', '');
        $registrants = RegisterEvent::where('name', 'like', '%' . $searchQuery . '%')->get();
        return view('EventRegistration.registrant', compact('registrants', 'searchQuery'));
    }
    
    public function showAttendees(Request $request) {
        $searchQuery = $request->input('searchQuery', ''); 
        $attendees = RegisterEvent::where('name', 'LIKE', "%{$searchQuery}%")->get(); 
        return view('EventRegistration.attendees', compact('attendees', 'searchQuery')); 
    }

    // Show registration form with event details
    public function showRegistrationForm($eventId)
    {
        $event = Event::findOrFail($eventId);  // It's safer to use findOrFail in case the event doesn't exist
        return view('EventRegistration.index', compact('event'));  // Pass the event to the view
    }
}
