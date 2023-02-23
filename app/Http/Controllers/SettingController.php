<?php

namespace App\Http\Controllers;

class SettingController extends Controller
{
    public function __invoke()
    {
        return view('settings.show');
    }
}
