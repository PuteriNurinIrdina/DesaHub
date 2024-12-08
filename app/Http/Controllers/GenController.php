<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        return view('index');
    }
}