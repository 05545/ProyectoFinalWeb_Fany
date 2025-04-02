<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('client.login');
    }

    public function iniciar_sesion(Request $request)
    {
       // dd($request->all());
        // Validamos los datos enviados
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        // Intentamos la autenticación
        if (Auth::attempt([
            'email_usuario' => $request->email,
            'password' => $request->password, 
        ])) {
            $user = Auth::user();
    
            // Verificar estado que el usuario esté activo
            if ($user->estatus_usuario !== 1) {
                Auth::logout();
                return redirect()->route('public.login')->withErrors(['usuario' => 'Usuario inactivo.']);
            }
    
            // Redirección basada en roles
            if ($user->id_rol === 745 && $user->estatus_usuario === 1) {
                return redirect()->route('admin.tablero');
            } elseif ($user->id_rol === 125 && $user->estatus_usuario === 1) {
               // return redirect()->route('operador.home');
            } elseif ($user->id_rol === 58 && $user->estatus_usuario === 1) {
              //  return redirect()->route('public.home');
            } else {
                Auth::logout();
                return redirect()->route('client.login')->withErrors(['usuario' => 'Acceso no autorizado.']);
            }
        }
    
        // Si la autenticación falla
        return redirect()->route('client.login')->withErrors(['usuario' => 'Credenciales incorrectas.']);
    }
    public function logout()
    {
        auth()->guard()->logout();
        return redirect('/login')->with('success', 'Logged out successfully');
    }
  
}
