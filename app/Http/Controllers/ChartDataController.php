<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartDataController extends Controller
{
    /*public function getEventsData()
    {
        // Query to count products grouped by month
        $results = DB::table('events')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupByRaw('MONTH(created_at)')
            ->get();
        
        // Initialize data for all 12 months
        $data = array_fill(0, 12, 0);

        // Fill in the data array with query results
        foreach ($results as $row) {
            $data[$row->month - 1] = $row->total; // Months are 1-indexed
        }

        return response()->json(['data' => $data]);
    }*/

    public function getProductsData()
    {
        // Query to count products grouped by month
        $results = DB::table('product')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupByRaw('MONTH(created_at)')
            ->get();
        
        // Initialize data for all 12 months
        $data = array_fill(0, 12, 0);

        // Fill in the data array with query results
        foreach ($results as $row) {
            $data[$row->month - 1] = $row->total; // Months are 1-indexed
        }

        return response()->json(['data' => $data]);
    }
}
