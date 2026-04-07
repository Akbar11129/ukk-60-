<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

        $userType = $request->input('user_type');

        return match ($userType) {
            'admin' => redirect()->intended(route('admin.dashboard')),
            'siswa' => redirect()->intended(route('siswa.dashboard')),
            default => redirect()->route('login'),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $guard = null;

        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
            $guard = 'siswa';
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $guard = 'admin';
        } else {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
