<?php

namespace App\Http\Controllers;

use App\Models\User;

class ClientsController extends Controller
{
    public function index()
    {
        return view('clients.index');
    }

    public function create()
    {
        return view('clients.create');
    }

    public function show(User $client)
    {
        return view('clients.show', [
            'client' => $client
        ]);
    }
}
