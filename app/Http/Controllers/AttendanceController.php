<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterEvent;
use App\Models\Event;

class AttendanceController extends Controller
{
    public function showAttendancePage($event_id)
    {
        $participants = RegisterEvent::where('event_id', $event_id)->get();
        $event = Event::find($event_id);
        $event_name = $event ? $event->name : '';
        return view('Attendance.attendance', compact('participants', 'event_id', 'event_name'));
    }

    public function markAttendance(Request $request, $event_id)
    {
        foreach ($request->attendance as $id => $status) {
            $participant = RegisterEvent::where('id',$id)->where('event_id', $event_id)->first();

            if($participant){
                $participant->attendance = $status;  
                $participant->save();
            }
            
        }

        return redirect()->back()->with('success', 'Kehadiran berjaya ditanda!');
    }
}
