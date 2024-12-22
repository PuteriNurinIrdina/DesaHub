<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class GenController extends Controller
{
    public function home()
    {
        $latestProducts = Product::latest()->take(3)->get();

        return view('home', compact('latestProducts'));
    }

    public function index()
    {
        return view('index');
    }
}