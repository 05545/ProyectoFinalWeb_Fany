<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\TablaUsuarios as Usuario;

class PerfilController extends Controller
{

    //vista para el perfil del administrador
    public function index()
    {
        return view('admon.perfil');
    }

    //vista para el perfil del operador
    public function index_operador()
    {
        return view('operador.perfil_op');
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        //dd(auth::user());
        $user = Usuario::find(Auth::id());
        $user->nombre_usuario = $request->input('nombre_usuario');
        $user->ap_usuario = $request->input('ap_usuario');
        $user->am_usuario = $request->input('am_usuario');
        $user->email_usuario = $request->input('email_usuario');
        if ($request->hasFile('imagen_usuario')) {
            // Eliminar imagen anterior, si existe
            if ($user->imagen_usuario) {
            $ruta_anterior = Str::after($user->imagen_usuario, 'storage/');
            Storage::disk('public')->delete($ruta_anterior);
            }

            $nueva_ruta = $request->file('imagen_usuario')->hashName();
            $ruta = $request->file('imagen_usuario')->storeAs('imagenes_usuarios', $nueva_ruta, 'public');
            $user->imagen_usuario = $ruta;
        }
        // Validar los datos del formulario
        $user->save();

        if($user->id_rol == 125){
            //ruta para operador
           return redirect()->route('operador.Perfil')->with('success', 'Perfil actualizado correctamente.');
        }else{
            //ruta para administrador
            return redirect()->route('admin.perfil')->with('success', 'Perfil actualizado correctamente.');
        }

    }

    public function cambiar_contrasena(Request $request, $id)
    {
        // Validamos los datos del formulario
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Esto espera que exista un campo new_password_confirmation
        ]);
    
        // Obtener el usuario a actualizar
        $user = Usuario::findOrFail($id);
    
        // Verificar que la contraseña actual sea correcta (asegúrate de usar la columna correcta)
        if (!Hash::check($request->input('current_password'), $user->password_usuario)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }
    
        // Actualizar la contraseña
        $user->password_usuario = Hash::make($request->input('new_password'));
        $user->save();
    
        if($user->id_rol == 125){
            //ruta para operador
            return redirect()->route('operador.Perfil')->with('success', 'Perfil actualizado correctamente.');
        }else{
            //ruta para administrador
           return redirect()->route('admin.perfil')->with('success', 'Perfil actualizado correctamente.');
        }
}
}