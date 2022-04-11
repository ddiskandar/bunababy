<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientsTagsController extends Controller
{
    public function show()
    {
        return view('clients.show-tags');
    }
}
