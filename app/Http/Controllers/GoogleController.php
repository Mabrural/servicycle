<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class GoogleController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        // Ambil data user dari Google
        $googleUser = Socialite::driver('google')->user();
        // Kalau error session, ganti dengan ->stateless()->user()

        // Cari user berdasarkan email, lalu update/insert google_id
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name'      => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
                'password'  => bcrypt(str()->random(16)), // biar tidak kosong
            ]
        );

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
