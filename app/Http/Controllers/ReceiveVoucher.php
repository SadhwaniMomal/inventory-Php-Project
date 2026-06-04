<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiveVoucher extends Controller
{
    
    public function  index(){
        return view('content.pages.finance.receivevoucher.index');
    }
}
