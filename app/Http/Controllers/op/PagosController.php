<?php

namespace App\Http\Controllers\op;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TablaPagos;

class PagosController extends Controller
{
    public function index()
    {
        $pagos = TablaPagos::query()
            ->join('usuarios', 'pagos.id_usuario', '=', 'usuarios.id_usuario')
            ->join('planes', 'pagos.id_plan', '=', 'planes.id_plan')
            ->select('pagos.*', 'usuarios.*', 'planes.*')
            ->where('usuarios.id_rol', 58)
            ->get();
        return view('operador.payValidate', compact('pagos'));
    }

    public function update_pagos(Request $request, $id_pago)
{
    // Encuentra el pago por su ID
    $pago = TablaPagos::findOrFail($id_pago);

    // Alterna el estado del pago
    $pago->estatus_pago = $pago->estatus_pago == 1 ? 0 : 1;

    // Guarda los cambios en la base de datos
    $pago->save();

    // Redirige con un mensaje de éxito
    return redirect()->back()->with('success', 'El estado del pago se ha actualizado correctamente.');
}
}
