<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ChartDataController extends Controller
{
    public function getEventsData(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $events = DB::table('event_module')
            ->select('month', DB::raw('COUNT(*) as count'))
            ->where('year', $year)
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

    public function getProductsData(Request $request)
    {
        $accountId = Auth::id();
        $year = $request->input('year', date('Y'));

        $products = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('account_id', $accountId)
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $data = array_fill(0, 12, 0);

        foreach ($products as $product) {
            $data[$product->month - 1] = $product->count;
        }

        return response()->json(['data' => $data]);
    }

    public function getCategoryData(Request $request)
    {
        $accountId = Auth::id();

        $year = $request->get('year');

        $categories = DB::table('product')
            ->select('category', DB::raw('COUNT(*) as total'))
            ->where('account_id', $accountId)
            ->when($year, function ($query) use ($year) {
                return $query->whereYear('created_at', $year);
            })
            ->groupBy('category')
            ->get();

        $categoryData = [
            "runcit" => 0,
            "kesihatan" => 0,
            "rumah" => 0,
            "bayi" => 0,
            "fesyen" => 0,
            "Automatif" => 0,
            "haiwan" => 0,
            "lainlain" => 0,
        ];

        foreach ($categories as $category) {
            if (isset($categoryData[$category->category])) {
                $categoryData[$category->category] = $category->total;
            }
        }

        return response()->json([
            'success' => true,
            'data' => array_values($categoryData),
        ]);
    }
}