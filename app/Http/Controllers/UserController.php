<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication successful, create user session
            $user = Auth::user();
            session(['user_id' => $user->id]);
            session(['name' => $user->name]);
            session(['apellido' => $user->apellido]);
            session(['email' => $user->email]);
    
            return response()->json(['message' => 'oki'], 200);
        } else {
            return response()->json(['message' => 'inv'], 200);
        }
    }

    

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
