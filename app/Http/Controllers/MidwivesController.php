<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MidwivesController extends Controller
{
    public function index()
    {
        return view('midwives.index');
    }

    public function create()
    {
        return view('midwives.create');
    }

    public function edit(User $midwife)
    {
        return view('midwife.edit', [
            'midwife' => $midwife
        ]);
    }
}
