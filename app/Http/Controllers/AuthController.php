<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;


use Validator;
use Hash;
use Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }
  
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Aluno'
        ]);
        
        return redirect()->route('login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    try {
        $token = JWTAuth::attempt($credentials);
        
        if (!$token) {
            return back()->with('error', 'Credenciais inválidas. Por favor, tente novamente.');
        }

        $request->session()->put('jwt_token', $token);
        dd($token);

        if (!auth()->check()) {
            return back()->with('error', 'Erro na autenticação. Por favor, tente novamente.');
        }

    } catch (\Exception $e) {
        return back()->with('error', 'Erro ao fazer login: ' . $e->getMessage());
    }
    
    return redirect()->route('dashboard');
}
    
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function profile()
    {
        return view('profile');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
