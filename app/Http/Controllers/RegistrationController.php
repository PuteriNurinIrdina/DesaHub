<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterEvent;
use App\Models\Event;
use App\Models\Account;
use App\Models\User;

class RegistrationController extends Controller
{

    public function index(Request $request)
    {
        $event_id = $request->query('event_id');
        $user = Account::findOrFail(auth()->id());
        if (!$event_id) {
            return redirect()->route('events.view')->with('error', 'Event ID is required.');
        }

        $event = Event::find($event_id);
        if (!$event) {
            return redirect()->route('events.view')->with('error', 'Event not found.');
        }

        return view('EventRegistration.index', compact('event', 'event_id'));
    }

    public function store(Request $request, $account_id, $event_id)
    {
        \Log::info($request->all());
        $user = Account::findOrFail($account_id);
        if (!$user)
            return redirect()->route('login')->with('error', 'Anda mesti log masuk dahulu.');
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

        $data['name'] = strtoupper($data['name']);
        $data['event_id'] = $event_id;
        $data['account_id'] = $user->id;

        RegisterEvent::create($data);


        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pendaftaran Berjaya!',
            ]);
        }

        return redirect()->route('event.register');
    }
    public function attendees($event_id) {
        $event = Event::find($event_id);
        $event_name = $event ? $event->name : '';
        $attendees = RegisterEvent::where('attendance', 1)->where('event_id', $event_id)->get();
        return view('EventRegistration.attendees', compact('attendees', 'event_name'));
    }

    public function absent(Request $request, $event_id) {
        $event = Event::find($event_id);
        $event_name = $event ? $event->name : '';
        $query = RegisterEvent::where('attendance', 0)->where('event_id', $event_id);

        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $nonAttendees = $query->get();
        return view('EventRegistration.absent', compact('nonAttendees', 'event_name'));
    }

    public function showAllRegistrants($event_id) {
        $event = Event::find($event_id);
        $event_name = $event ? $event->name : '';
        $registrants = RegisterEvent::where('event_id', $event_id)->get(); 
        return view('EventRegistration.registrant', compact ('registrants', 'event_id', 'event_name'));
    }

    public function showRegistrants(Request $request, $event_id) {
        $searchQuery = $request->input('searchQuery', '');
        $registrants = RegisterEvent::where('event_id', $event_id)->where('name', 'like', '%' . $searchQuery . '%')->get();
        return view('EventRegistration.registrant', compact('registrants', 'searchQuery'));
    }
    
    public function showAttendees(Request $request) {
        $searchQuery = $request->input('searchQuery', ''); 
        $attendees = RegisterEvent::where('event_id', $event_id)
        ->where('name', 'like', '%' . $searchQuery . '%')->get();
        return view('EventRegistration.attendees', compact('attendees', 'searchQuery')); 
    }

    public function showRegistrationForm($account_id, $event_id)
    {
        $account_id = Account::find($account_id);
        $event = Event::find($event_id);
        if (!$account_id) {
            dd("Account not found for ID: $account_id");
        }
    
        if (!$event) {
            dd("Event not found for ID: $event_id");
        }
        $event_name = $event ? $event->name : '';
        return view('EventRegistration.index', compact('account_id', 'event', 'event_name'));  
    }
}
