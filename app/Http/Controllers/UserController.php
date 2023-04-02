<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserController extends Controller
{
    public function auth_user(Request $request): RedirectResponse
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //Recordarme
        if(Auth::viaRemember()){
            // test
        }
        if(Auth::attempt($credenciales)){
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return back()->withErrors([
            'email' => 'Las credenciales ingresadas no coinciden con nuestros registros.'
        ])->onlyInput('email');
    }
}
