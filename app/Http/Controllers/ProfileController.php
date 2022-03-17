<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('client.profile.show');
    }

    public function edit()
    {
        return view('client.profile.edit');
    }
}
