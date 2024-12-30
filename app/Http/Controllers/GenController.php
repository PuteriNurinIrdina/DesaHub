<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Product;

class GenController extends Controller
{
    public function home()
    {
        $latestEvents = Event::latest()->take(6)->get();
        $latestProducts = Product::latest()->take(3)->get();

        return view('home', compact('latestEvents', 'latestProducts'));
    }

    public function index()
    {
        return view('index');
    }
}