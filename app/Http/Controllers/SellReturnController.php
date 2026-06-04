<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellReturnController extends Controller
{
    
    public function index()
    {
        return view('content.pages.sell.return.index');
    }
}
