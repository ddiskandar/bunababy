<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // dd($googleUser);

        $user = User::updateOrCreate([
            'email' => $googleUser->email,
        ], [
            'id' => User::max('id') + 1,
            'google_id' => $googleUser->id,
            'name' => $googleUser->name,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);

        $profile = Profile::where('user_id', $user->id)->first();

        if ($profile) {
            $profile->update([
                'photo' => $googleUser->avatar
            ]);
        } else {
            $user->profile()->create([
                'photo' => $googleUser->avatar
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}
