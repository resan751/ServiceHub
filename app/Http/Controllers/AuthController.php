<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\AuthServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    protected $authServices;

    public function __construct(AuthServices $AuthServices)
    {
        $this->authServices = $AuthServices;
    }
    public function login()
    {
        return view('login.login');
    }

    public function  authenticate(Request $request)
    {
        return $this->authServices->authenticate($request);

        Log::warning("Login failed", ['email' => $request->email, 'ip' => $request->ip()]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('login.register');
    }
    public function store(Request $request)
    {
        return $this->authServices->store($request);
    }
    public function logout(Request $request)
    {
        return $this->authServices->logout($request);
    }

    //crud
    public function index(): view
    {
        $User = User::latest()->paginate(5);
        $User = User::orderBy('id_user', 'asc')->get();

        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();
        return view('layout.dashboard', compact('User', 'adminCount', 'userCount'));
    }

    public function edit(string $id_user): View
    {
        $User = User::findOrFail($id_user);
        return view('form.upuser', compact('User'));
    }

    public function update(Request $request, $id_user): RedirectResponse
    {
        $request->validate([
            'username' => 'required|min:5',
            'role' => 'required|min:5',
            'email' => 'required|min:5',
            'password' => 'required|min:5'
        ]);

        $User = User::findOrFail($id_user);

        $User->update([
            'username' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('dashboard.index');
    }

    public function destroy($id_user): Redirectresponse
    {
        $User = User::findOrFail($id_user);
        $User->delete();
        return back();
    }



}
