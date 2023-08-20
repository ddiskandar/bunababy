<?php

namespace App\Http\Controllers;


class UserProfileController extends Controller
{
    public function __invoke()
    {
        return view('user.show');
    }
}
