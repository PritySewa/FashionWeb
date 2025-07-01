<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function success(){
        return view('users.payment.success');
    }
    public function failure(){
        return view('users.payment.failure');
    }
}

