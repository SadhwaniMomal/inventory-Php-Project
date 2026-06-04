<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalVoucher extends Controller
{

    
    public function  index(){
        return view('content.pages.finance.journalvoucher.index');
    }

    
}
