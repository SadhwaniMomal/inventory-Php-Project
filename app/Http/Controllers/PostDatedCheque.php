<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostDatedCheque extends Controller
{
    
    public function  index(){
        return view('content.pages.finance.postdatedcheque.index');
    }
}
