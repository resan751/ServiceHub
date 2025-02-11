<?php

namespace app\Services;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\RedirectResponse;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthServices
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Log::info("Login successful", ['email' => $request->email, 'ip' => $request->ip()]);

            return redirect()->route('dash');
        }

    }

    public function store(Request $request)
    {
        $ValidatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:5',
        ]);

        User::create([
            'username' => $ValidatedData['username'],
            'email' => $ValidatedData['email'],
            'password' => bcrypt($ValidatedData['username']),
        ]);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
