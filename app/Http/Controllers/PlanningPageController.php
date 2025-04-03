<?php

namespace App\Http\Controllers;

use App\Models\TablaPagos;
use App\Models\TablaPlanes;
use App\Models\TablaUsuarios_Planes;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanningPageController extends Controller
{
    public function planning()
    {
        $planes = TablaPlanes::where('estatus_plan', 1)->orderBy('precio_plan', 'asc')->get();

        $planContratado = null;

        if (Auth::check()) {
            $planContratado = TablaUsuarios_Planes::with('plan')
                ->where('id_usuario', Auth::id())
                ->where('fecha_fin_plan', '>', now())
                ->latest('fecha_registro_plan')
                ->first();
        }

        if ($planContratado) {
            $planContratado->fecha_registro_plan = Carbon::parse($planContratado->fecha_registro_plan);
            $planContratado->fecha_fin_plan = Carbon::parse($planContratado->fecha_fin_plan);
        }

        return view('client.planning', compact('planes', 'planContratado'));
    }

    public function contratar(Request $request)
    {
        $request->validate([
            'id_plan' => 'required|exists:planes,id_plan',
            'tarjeta_pago' => 'required|string',
            'fecha_expiracion' => 'required|string',
            'cvv' => 'required|string',
            'nombre_tarjeta' => 'required|string',
        ]);

        $usuario = auth()->user();
        $idUsuario = $usuario->id_usuario;

        $pagoPendiente = TablaPagos::where('id_usuario', $idUsuario)
            ->where('estatus_pago', 0)
            ->first();

        if ($pagoPendiente) {
            return redirect()->route('cliente.pagos')->with('error', 'Ya tienes un proceso de pago pendiente. Por favor, completa ese proceso antes de contratar otro plan.');
        }

        $planActivo = TablaPagos::where('id_usuario', $idUsuario)
            ->where('estatus_pago', 1)
            ->first();

        if ($planActivo) {
            return redirect()->back()->with('error', 'Ya tienes un plan contratado. Cancela o espera a que termine.');
        }

        $idPlan = $request->input('id_plan');
        $plan = TablaPlanes::find($idPlan);

        if (!$plan) {
            return redirect()->back()->with('error', 'El plan seleccionado no existe.');
        }

        $tarjetaPago = $request->input('tarjeta_pago');
        $tarjetaPago = preg_replace('/\D/', '', $tarjetaPago);
        $tarjetaFormateada = '••••-••••-••••-' . substr($tarjetaPago, -4);

        $pago = new TablaPagos();
        $pago->fecha_registro_pago = now();
        $pago->estatus_pago = 0; 
        $pago->monto_pago = $plan->precio_plan;
        $pago->tarjeta_pago = $tarjetaFormateada;
        $pago->id_usuario = $idUsuario;
        $pago->id_plan = $idPlan;
        $pago->save();

        return redirect()->route('cliente.pagos')->with('success', 'Se ha registrado tu solicitud de pago. Por favor, completa el proceso.');
    }
}
