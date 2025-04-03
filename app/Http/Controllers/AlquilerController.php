<?php

namespace App\Http\Controllers;

use App\Models\TablaAlquileres;
use App\Models\TablaPlanes;
use App\Models\TablaStreaming;
use App\Models\TablaUsuarios_Planes;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlquilerController extends Controller
{
    public function alquiler()
    {
        return view('client.alquiler');
    }

    public function alquilerElemento($idStreaming)
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para alquilar contenido.');
        }

        $streaming = TablaStreaming::find($idStreaming);

        if (!$streaming) {
            return redirect()->back()->with('error', 'El contenido solicitado no existe.');
        }

        $usuarioPlan = TablaUsuarios_Planes::where('id_usuario', $usuario->id_usuario)
            ->where('fecha_fin_plan', '>=', Carbon::now()->format('Y-m-d'))
            ->first();

        if (!$usuarioPlan) {
            return redirect()->back()->with('error', 'El contenido solicitado no existe.');
        }

        $existingRental = TablaAlquileres::where('id_usuario', $usuario->id_usuario)
            ->where('id_streaming', $idStreaming)
            ->where('estatus_alquiler', -1)
            ->first();

        if ($existingRental) {
            return redirect()->back()->with('error', 'El contenido solicitado no existe.');
        }

        $plan = TablaPlanes::find($usuarioPlan->id_plan);

        $activeRentals = TablaAlquileres::where('id_usuario', $usuario->id_usuario)
            ->where('estatus_alquiler', 'activo')
            ->count();

        if ($activeRentals >= $plan->cantidad_limite_plan) {
            return redirect()->back()->with('error', 'El contenido solicitado no existe.');
        }

        $alquiler = new TablaAlquileres();
        $alquiler->fecha_inicio_alquiler = Carbon::now()->format('Y-m-d H:i:s');

        $fechaFin = Carbon::now();
        switch ($plan->tipo_plan) {
            case 8:
                $fechaFin = $fechaFin->addDays(7);
                break;
            case 16:
                $fechaFin = $fechaFin->addDays(30);
                break;
            case 32:
                $fechaFin = $fechaFin->addDays(365);
                break;
            default:
                $fechaFin = $fechaFin->addHours(48);
                break;
        }

        $alquiler->fecha_fin_alquiler = $fechaFin->format('Y-m-d H:i:s');
        $alquiler->estatus_alquiler = -1;
        $alquiler->id_streaming = $streaming->id_streaming;
        $alquiler->id_usuario = $usuario->id_usuario;
        $alquiler->save();

        return redirect()->route('catalogo')->with('success', '¡Has alquilado "' . $streaming->nombre_streaming . '" exitosamente! Disfruta de tu contenido.');
    }

    public function encontrarAlquiler()
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus alquileres.');
        }

        $alquileres = TablaAlquileres::where('id_usuario', $usuario->id_usuario)
            ->with('streaming')
            ->get();

        $enProceso = $alquileres->where('estatus_alquiler', -1);
        $culminados = $alquileres->where('estatus_alquiler', 1)
            ->where('fecha_fin_alquiler', '<', Carbon::now());
        $cancelados = $alquileres->where('estatus_alquiler', 1)
            ->where('fecha_fin_alquiler', '>', Carbon::now());

        return view('client.alquiler', compact('enProceso', 'culminados', 'cancelados'));
    }

    public function cancelarAlquiler($idAlquiler)
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para cancelar un alquiler.');
        }

        $alquiler = TablaAlquileres::where('id_alquiler', $idAlquiler)
            ->where('id_usuario', $usuario->id_usuario)
            ->first();

        if (!$alquiler) {
            return redirect()->route('cliente.alquiler.info')->with('error', 'El alquiler no existe o no tienes permiso para cancelarlo.');
        }

        $alquiler->estatus_alquiler = 1;
        $alquiler->save();

        return redirect()->route('cliente.alquiler.info')->with('success', 'El alquiler ha sido cancelado exitosamente.');
    }
}
