<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ChartDataController extends Controller
{
    public function getEventsData()
    {
        $accountId = Auth::id();

        $events = DB::table('event_module')
            ->select('month', DB::raw('COUNT(*) as count'))
            ->where('account_id', $accountId)
            ->groupBy('month')
            ->orderByRaw("FIELD(month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')")
            ->get();

        $data = array_fill(0, 12, 0);

        $monthMap = [
            'January' => 0, 'February' => 1, 'March' => 2, 'April' => 3,
            'May' => 4, 'June' => 5, 'July' => 6, 'August' => 7,
            'September' => 8, 'October' => 9, 'November' => 10, 'December' => 11,
        ];

        foreach ($events as $event) {
            $monthIndex = $monthMap[$event->month] ?? null;
            if ($monthIndex !== null) {
                $data[$monthIndex] = $event->count;
            }
        }

        return response()->json(['data' => $data]);
    }

    public function getProductsData()
    {
        $accountId = Auth::id();
        $products = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('account_id', $accountId)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        $data = array_fill(0, 12, 0);

        foreach ($products as $product) {
            $data[$product->month - 1] = $product->count; // Map to zero-based index
        }
    
        return response()->json(['data' => $data]);
    }
}