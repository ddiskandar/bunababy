<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
