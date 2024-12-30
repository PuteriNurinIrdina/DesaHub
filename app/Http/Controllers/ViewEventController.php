<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewEventController extends Controller
{
       // Display all events or filter them based on user input
       public function view(Request $request, $account_id)
       {
            $account_id = Auth::user()->id;
           $query = Event::query();
           // Apply filters only if they are provided
           if ($request->filled('date')) {
               $query->where('date', $request->date);
           }
   
           if ($request->filled('day')) {
               $query->where('day_of_week', $request->day);
           }
   
           if ($request->filled('month')) {
               $query->where('month', $request->month);
           }
   
           if ($request->filled('year')) {
               $query->where('year', $request->year);
           }
   
           if ($request->filled('type')) {
               $query->where('type', $request->type);
           }

           if ($request->filled('date_range')) {
                $dates = explode(' to ', $request->date_range);
                $startDate = \Carbon\Carbon::parse($dates[0])->format('Y-m-d');
                $endDate = isset($dates[1]) ? \Carbon\Carbon::parse($dates[1])->format('Y-m-d') : $startDate;
        
                \Log::info('Filtering between ' . $startDate . ' and ' . $endDate);
        
                $query->whereBetween('date', [$startDate, $endDate]);
            }
   
           // Fetch the filtered or all events
           $events = $query->get();

           $days = Event::select('day_of_week')->distinct()->pluck('day_of_week');
           $months = Event::select('month')->distinct()->pluck('month');
           $years = Event::select('year')->distinct()->pluck('year');
   
           // Return the view with events
           return view('events.view', compact('events', 'account_id', 'days', 'months', 'years'), ['events' => $events]);
       }
    
    // Show the details of a specific event
    public function detail($id)
    {
        // Find the event by ID
        $event = Event::findOrFail($id);

        // Get other events excluding the current one (optional: adjust this query as needed)
        $otherEvents = Event::where('id', '!=', $id)->get(); 

        // Pass both the current event and other events to the view
        return view('events.detail', compact('event', 'otherEvents'));
    }

}
