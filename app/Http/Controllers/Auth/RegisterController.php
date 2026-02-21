<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->validated()['name'],
            'email' => $request->validated()['email'],
            'password' => $request->validated()['password'],
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('site.dashboard')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }
}
