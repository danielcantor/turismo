<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
        $user = User::where('email', $email)->first();
    
        if ($user && Hash::check($password, $user->password)) {
            session(['user_id' => $user->id]);
            session(['name' => $user->name]);
            session(['apellido' => $user->apellido]);
            session(['email' => $user->email]);
            return response()->json(['message' => 'ok'], 200);
        } else {
            return response()->json(['message' => 'inv'], 200);
        }
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        if ($user) {
            session(['user_id' => $user->id]);
            session(['name' => $user->name]);
            session(['email' => $user->email]);

            return response()->json(['message' => 'Registro ok'], 200);
        } else {
            return response()->json(['message' => 'Registro fail'], 500);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
