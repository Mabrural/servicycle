<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Mail\LoginMail;
use Illuminate\Support\Facades\Mail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Kirim email notifikasi login berhasil
        if ($user && $user->email) {
            Mail::to($user->email)->send(new LoginMail($user));
        }

        // Tentukan route default berdasarkan role
        switch ($user->role) {
            case 'admin':
                $defaultRoute = route('dashboard.admin');
                break;

            case 'workshop':
                $defaultRoute = route('dashboard.workshop');
                break;

            case 'vehicle_owner':
                $defaultRoute = route('dashboard.user');
                break;

            default:
                $defaultRoute = route('dashboard');
                break;
        }

        // Redirect ke intended route jika ada, kalau tidak ke route default
        return redirect()->intended($defaultRoute);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
