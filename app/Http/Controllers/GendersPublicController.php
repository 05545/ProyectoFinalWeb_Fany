<?php

namespace App\Http\Controllers;

use App\Models\TablaGeneros;
use Illuminate\Http\Request;

class GendersPublicController extends Controller
{
    public function Gender()
    {
        $generos = TablaGeneros::where('estatus_genero', 1)
            ->withCount([
                'streamings' => function ($query) {
                    $query->where('estatus_streaming', 1);
                }
            ])
            ->get();
        
        foreach ($generos as $genero) {
            $genero->miniaturasStreaming = $genero->streamings()
                ->where('estatus_streaming', 1)
                ->take(3)
                ->get(['id_streaming', 'nombre_streaming', 'caratula_streaming']);
        }

        return view('client.genders', compact('generos'));
    }

    public function detalleGenero($id_genero){
        $genero = TablaGeneros::with(['streamings' => function ($query) {
            $query->where('estatus_streaming', 1);
        }])->findOrFail($id_genero);
        
        return view('client.detalle-genero', compact('genero'));
    }
}
