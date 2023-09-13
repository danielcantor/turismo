<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            $name = $user->name;
            $apellido = $user->apellido;
    
            return response()->json(['message' => 'success', 'name' => $name, 'apellido' => $apellido], 200);
        } else {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }
    }

    public function registernow(Request $request)
    {
        // Valida los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        try {
            DB::beginTransaction();
    
            $user = new User([
                'name' => $validatedData['name'],
                'apellido' => $validatedData['apellido'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
    
            if ($user->save()) {
                DB::commit();
    
                // Establece las sesiones para el usuario registrado
                session(['user_id' => $user->id]);
                session(['name' => $user->name]);
                session(['apellido' => $user->apellido]);
                session(['email' => $user->email]);
    
                return response()->json(['message' => 'Registro exitoso'], 200);
            } else {
                DB::rollback();
                return response()->json(['message' => 'Error al crear el usuario'], 500);
            }
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return response()->json(['message' => 'Error interno del servidor'], 500);
        }
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
