<?php

namespace App\Http\Controllers\op;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TablaPagos;
use App\Models\TablaRoles as roles;
use App\Models\TablaUsuarios as Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientesController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $usuarios = Usuario::all()->where('id_rol', 58);
        $Pagos = TablaPagos::all();
        return view('operador.client', compact('usuarios', 'Pagos'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'ap_usuario' => 'required|string',
            'am_usuario' => 'required|string',
            'sexo_usuario' => 'required|max:255',
            'email_usuario' => 'required|string|max:255',
            'password_usuario' => 'required|string|max:255',
            'imagen_usuario' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'estatus_usuario' => 'required|string|max:255',
        ]);

        
        $usuario= new Usuario();

        //revisar que funcione las rutas
        if ($request->hasFile('imagen_usuario')) {
            $nombreArchivo = $request->file('imagen_usuario')->hashName();
            $ruta = $request->file('imagen_usuario')->storeAs('imagenes_usuarios', $nombreArchivo, 'public');
            $usuario->imagen_usuario = $ruta;
        }

        
        $usuario->estatus_usuario= $request->estatus_usuario;
        $usuario->nombre_usuario= $request->nombre_usuario;
        $usuario->ap_usuario= $request->ap_usuario;
        $usuario->am_usuario= $request->am_usuario;
        $usuario->sexo_usuario= $request->sexo_usuario;
        $usuario->email_usuario= $request->email_usuario;
        $usuario->password_usuario = Hash::make($request->password_usuario);
        $usuario->id_rol= 58; // Asignar el ID del rol correspondiente
        $usuario->save();
        return redirect()->route('operador.clientes')->with('success', 'Usuario creado correctamente');

        // return redirect()->route('ruta.deseada')->with('success', 'Cliente creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
       // dd($request->all());
        // Validar los datos del formulario
        $request->validate([
            'modal_nombre_usuario' => 'required|string|max:255',
            'modal_ap_usuario' => 'required|string',
            'modal_am_usuario' => 'required|string',
            'modal_sexo_usuario' => 'required|max:255',
            'modal_email_usuario' => 'required|string|max:255',
            'modal_password_usuario' => 'nullable|string|max:255',
            'modal_imagen_usuario' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'modal_estatus_usuario' => 'required|string|max:255',
        ]);

        // Obtener el usuario a actualizar
        $usuario = Usuario::findOrFail($id);

        // Actualizar los campos del usuario
        if ($request->hasFile('modal_imagen_usuario')) {
            Storage::disk('public')->delete($usuario->imagen_usuario);
            $nombreArchivo = $request->file('imagen_usuario')->hashName();
            $ruta = $request->file('imagen_usuario')->storeAs('imagenes_usuarios', $nombreArchivo, 'public');
            $usuario->imagen_usuario = $ruta;
        }
        $usuario->estatus_usuario = $request->modal_estatus_usuario;
        $usuario->nombre_usuario = $request->modal_nombre_usuario;
        $usuario->ap_usuario = $request->modal_ap_usuario;
        $usuario->am_usuario = $request->modal_am_usuario;
        $usuario->sexo_usuario = $request->modal_sexo_usuario;
        $usuario->email_usuario = $request->modal_email_usuario;

        if ($request->filled('modal_password_usuario')) {
            $usuario->password_usuario = Hash::make($request->password_usuario);
        }

        // Guardar los cambios en la base de datos
        $usuario->save();

        return redirect()->route('operador.home')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        // Obtener el usuario a eliminar
        $usuario = Usuario::findOrFail($id);

        // Eliminar la imagen del usuario si existe
        if ($usuario->imagen_usuario) {
            Storage::disk('public')->delete($usuario->imagen_usuario);
        }

        // Eliminar el usuario de la base de datos
        $usuario->delete();

        return redirect()->route('operador.home')->with('success', 'Usuario eliminado correctamente');
    }
}
