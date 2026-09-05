<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class AuthController extends Controller
{
    public function create(): Response
    {
        return response()->view('auth.login')->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau password tidak sesuai.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return to_route('surat.index');
    }

    public function redirectToGoogle(): RedirectResponse
    {
        if (! config('services.google.client_id') || ! config('services.google.client_secret')) {
            return to_route('login')->withErrors(['email' => 'Login Google belum dikonfigurasi oleh administrator.']);
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable) {
            return to_route('login')->withErrors(['email' => 'Login dengan Google gagal. Silakan coba lagi.']);
        }

        if (! $googleUser->getEmail()) {
            return to_route('login')->withErrors(['email' => 'Akun Google tidak menyediakan alamat email.']);
        }

        $user = User::firstOrNew(['email' => $googleUser->getEmail()]);
        $user->name = $googleUser->getName() ?: $googleUser->getNickname() ?: 'Pengguna Google';
        $user->google_id = $googleUser->getId();
        $user->email_verified_at ??= now();
        $user->role ??= 'penduduk';
        $user->password ??= bcrypt(str()->random(40));
        $user->save();

        Auth::login($user, true);
        request()->session()->regenerate();

        return to_route('surat.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}