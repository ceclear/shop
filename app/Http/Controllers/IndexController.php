<?php

namespace App\Http\Controllers;



class IndexController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }
}
