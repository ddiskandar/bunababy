<?php

namespace App\Http\Controllers;

class PaymentsController extends Controller
{
    public function index()
    {
        return view('payments.index');
    }
}
