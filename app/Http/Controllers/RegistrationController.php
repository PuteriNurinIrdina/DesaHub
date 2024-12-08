<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterEvent;

class RegistrationController extends Controller
{
    public function index() {
        return view('EventRegistration.index');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'ic_num' => 'required|digits:12',
            'name' => 'required',
            'phone_num' => 'required|digits_between:10,11',
            'gender' => 'required',
            'address' => 'required',
            'poscode' => 'required|digits:5',
            'state' => 'required',
            'email' => 'nullable|email',
            'house_category' => 'required',
            'age_class' => 'required'
        ], 
        [
            'ic_num.required' => 'Sila Isi No Kad Pengenalan Anda.',
            'ic_num.digits' => "No Kad Pengenalan Mestilah Mengandungi 12 Digit Sahaja (tanpa '-')",
            'name.required' => 'Sila Isi Nama Anda.',
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
        ]);
    
        $data['name'] = strtoupper($data['name']);
        RegisterEvent::create($data);
    
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pendaftaran Berjaya!',
            ]);
        } 
    
        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran berjaya!'
        ]);
    }
    
    public function attendees() {
        $attendees = RegisterEvent::where('attendance', 1)->get();
        return view('EventRegistration.attendees', compact('attendees'));
    }

    public function absent() {
        $nonAttendees = RegisterEvent::where('attendance', 0)->get();
        return view('EventRegistration.absent', compact('nonAttendees'));
    }

    public function showAllRegistrants() {
        $registrants = RegisterEvent::all(); 
    
        return view('EventRegistration.registrant', compact('registrants'));
    }
    
    
    
}
?>