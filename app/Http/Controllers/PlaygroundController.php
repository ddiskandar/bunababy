<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaygroundController extends Controller
{
    public function index()
    {
        session()->put('foo', ['bar']);

        if (session()->has('foo')) {

            session()->push('foo', 'baz');
            session()->push('foo', 'zzz');
            // dd('here');
        }


        return view('playground');
    }
}
