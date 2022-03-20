<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MidwifeController extends Controller
{

    public function edit($id)
    {
        $midwife = User::findOrFail($id);

        return view('admin.midwife.edit', [
            'midwife' => $midwife
        ]);
    }
}
