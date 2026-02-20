<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(LoginRequest $request)
    {

        // Validate form data
        $credentials = $request->only('email', 'password');

        // Attempt authentication and return error on failure
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Credenciais invalidas',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('site.dashboard');

    }

    // Log the user out of the application.
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('site.index');
    }
}
