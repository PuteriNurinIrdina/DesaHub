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
        $events = Event::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('account_id', $accountId)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
  
        $data = array_fill(0, 12, 0);

        foreach ($results as $row) {
            $data[$row->month - 1] = $row->total; // Months are 1-indexed
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