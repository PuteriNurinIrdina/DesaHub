<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterEvent;

class AttendanceController extends Controller
{
    public function showAttendancePage()
    {
        $participants = RegisterEvent::all();
        return view('Attendance.attendance', compact('participants'));
    }

    public function markAttendance(Request $request)
    {
        foreach ($request->attendance as $id => $status) {
            $participant = RegisterEvent::find($id);

            $participant->attendance = $status;  
            $participant->save();
        }

        return redirect()->back()->with('success', 'Kehadiran berjaya ditanda!');
    }
}
