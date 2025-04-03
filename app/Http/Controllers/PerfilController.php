<?php

namespace App\Http\Controllers;

use App\Models\TablaAlquileres;
use App\Models\TablaPlanes;
use App\Models\TablaUsuarios_Planes;
use Carbon\Carbon;
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

        if ($user->id_rol == 125) {
            //ruta para operador
            return redirect()->route('operador.Perfil')->with('success', 'Perfil actualizado correctamente.');
        } else {
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

        if ($user->id_rol == 125) {
            //ruta para operador
            return redirect()->route('operador.Perfil')->with('success', 'Perfil actualizado correctamente.');
        } else {
            //ruta para administrador
            return redirect()->route('admin.perfil')->with('success', 'Perfil actualizado correctamente.');
        }
    }

    public function perfil()
    {
        $usuario = Auth::user();
        
        if (!$usuario) {
            return redirect()->route('client.login');
        }
        
        $usuarioPlan = TablaUsuarios_Planes::where('id_usuario', $usuario->id_usuario)
            ->where('fecha_fin_plan', '>=', now())
            ->orderBy('fecha_fin_plan', 'desc')
            ->first();
            
        $plan = null;
        if ($usuarioPlan) {
            $plan = TablaPlanes::find($usuarioPlan->id_plan);
        }
        
        $proximaRenovacion = $usuarioPlan ? $usuarioPlan->fecha_fin_plan : null;
        $planes = TablaPlanes::where('estatus_plan', 1)->get();
        
        $alquileres = TablaAlquileres::with('streaming')
            ->where('id_usuario', $usuario->id_usuario)
            ->orderBy('fecha_inicio_alquiler', 'desc')
            ->take(4) 
            ->get();
            
        $totalAlquileres = TablaAlquileres::where('id_usuario', $usuario->id_usuario)->count();
        $alquileresActivos = TablaAlquileres::where('id_usuario', $usuario->id_usuario)
            ->where('estatus_alquiler', 1)
            ->where('fecha_fin_alquiler', '>=', now())
            ->count();
            
        $limiteAlquileres = $plan ? $plan->cantidad_limite_plan : 0;
        $alquileresDisponibles = $limiteAlquileres - $alquileresActivos;
        if ($alquileresDisponibles < 0) $alquileresDisponibles = 0;
        
        $nombreCompleto = $usuario->nombre_usuario . ' ' . $usuario->ap_usuario . ' ' . $usuario->am_usuario;
        
        $fechaRegistro = Carbon::parse($usuario->created_at)->format('d \d\e F, Y');
        $fechaRenovacion = $proximaRenovacion ? Carbon::parse($proximaRenovacion)->format('d \d\e F, Y') : 'No disponible';
        
        return view('client.account', compact(
            'usuario',
            'nombreCompleto',
            'fechaRegistro',
            'plan',
            'fechaRenovacion',
            'alquileres',
            'totalAlquileres',
            'alquileresActivos',
            'alquileresDisponibles',
            'planes',
            'limiteAlquileres'
        ));
    }
}