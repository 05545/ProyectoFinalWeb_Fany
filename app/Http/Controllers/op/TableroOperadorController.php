<?php

namespace App\Http\Controllers\op;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TablaUsuarios as Usuario;
use App\Models\TablaPagos;

class TableroOperadorController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all()->where('id_rol', 58);
        $Pagos = TablaPagos::all();
        return view('operador.dashboard', compact('usuarios', 'Pagos'));
    }

 
}
