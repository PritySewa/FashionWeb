<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function success() {
        // Redirect to welcome with flash success message
        return redirect()->route('welcome')->with('success', 'Payment successful! Thank you & happy shopping.');
    }

    public function failure() {
        // Redirect to welcome with flash error message
        return redirect()->route('welcome')->with('error', 'Payment failed. Please try again.');
    }

}

