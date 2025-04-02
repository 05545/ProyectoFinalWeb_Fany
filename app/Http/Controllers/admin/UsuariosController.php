<?php


namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TablaRoles;
use App\Models\TablaUsuarios as Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function index()
    {
        $roles=TablaRoles::all();
        return view('admon.usuarios', compact('roles'));
    }

    public function store(Request $request){

        $request->validate([
            'nombre_usuario' => 'required|string',
            'ap_usuario' => 'required|string',
            'am_usuario' => 'required|string',
            'sexo_usuario' => 'required|in:1,0',
            'email_usuario' => 'required|string|email',
            'password_usuario' => 'required|string',
            'imagen_usuario' => 'nullable|image',
            'id_rol' => 'required|exists:roles,id_rol',
            'estatus_usuario' => 'required|in:1,0'
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
        $usuario->id_rol= $request->id_rol;
        $usuario->save();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario creado correctamente');
    }

    public function update(Request $request, $id){
        $request->validate([
            'modal_nombre_usuario' => 'required|string',
            'modal_ap_usuario' => 'required|string',
            'modal_am_usuario' => 'required|string',
            'modal_sexo_usuario' => 'required|in:1,0',
            'modal_email_usuario' => 'required|string|email',
            'modal_password_usuario' => 'nullable|string',
            'modal_imagen_usuario' => 'nullable|image',
            'modal_id_rol' => 'required|exists:roles,id_rol',
            'modal_estatus_usuario' => 'required|in:1,0'
        ]);

        $usuario = Usuario::findOrFail($id);

        if ($request->hasFile('modal_imagen_usuario')) {
            // Eliminar imagen anterior, si existe
            if ($usuario->imagen_usuario) {
            $ruta_anterior = Str::after($usuario->imagen_usuario, 'storage/');
            Storage::disk('public')->delete($ruta_anterior);
            }

            $nueva_ruta = $request->file('modal_imagen_usuario')->hashName();
            $ruta = $request->file('modal_imagen_usuario')->storeAs('imagenes_usuarios', $nueva_ruta, 'public');
            $usuario->imagen_usuario = $ruta;
        }

        $usuario->estatus_usuario = $request->modal_estatus_usuario;
        $usuario->nombre_usuario = $request->modal_nombre_usuario;
        $usuario->ap_usuario = $request->modal_ap_usuario;
        $usuario->am_usuario = $request->modal_am_usuario;
        $usuario->sexo_usuario = $request->modal_sexo_usuario;
        $usuario->email_usuario = $request->modal_email_usuario;

        if ($request->filled('modal_password_usuario')) {
            $usuario->password_usuario = Hash::make($request->modal_password_usuario);
        }

        $usuario->id_rol = $request->modal_id_rol;
        $usuario->save();

        return redirect()->route('admin.tablero')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id){
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->back()->with('success', 'Usuario eliminado');
    }


}
