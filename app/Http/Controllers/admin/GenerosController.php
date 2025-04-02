<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TablaGeneros as Generos;

class GenerosController extends Controller
{
    public function index()
    {
        return view('admon.type_genres');
    }

    public function store(Request $request){
        $request->validate([
            'nombre_genero' => 'required|string',
            'descripcion_genero' => 'required|string',
            'estatus_genero' => 'required|in:1,0,-1'
        ]);

        $genero = new Generos();
        $genero->nombre_genero = $request->nombre_genero;
        $genero->descripcion_genero = $request->descripcion_genero;
        $genero->estatus_genero = $request->estatus_genero;
        $genero->save();
        return redirect()->route('admin.generos');
        
    }

    public function update(Request $request, $id){
        $request->validate([
            'modal_nombre_genero' => 'required|string',
            'modal_descripcion_genero' => 'required|string',
            'modal_estatus_genero' => 'required|in:1,0,-1'
        ]);

        $genero = Generos::find($id);
        $genero->nombre_genero = $request->modal_nombre_genero;
        $genero->descripcion_genero = $request->modal_descripcion_genero;
        $genero->estatus_genero = $request->modal_estatus_genero;
        $genero->save();
        return redirect()->route('admin.tablero')->with('success', 'Genero actualizado correctamente');
    }

    public function destroy($id){
        $genero = Generos::find($id);
        $genero->delete();
        return redirect()->route('admin.tablero')->with('success', 'Genero eliminado correctamente');
    }
}
