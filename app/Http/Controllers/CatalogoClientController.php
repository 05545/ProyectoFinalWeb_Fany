<?php

namespace App\Http\Controllers;

use App\Models\TablaGeneros;
use App\Models\TablaStreaming;
use Illuminate\Http\Request;

class CatalogoClientController extends Controller
{
    public function catalogo(Request $request)
    {
        $generos = TablaGeneros::where('estatus_genero', 1)->get();

        $query = TablaStreaming::query();
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nombre_streaming', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->has('genre') && !empty($request->genre)) {
            $query->where('id_genero', $request->genre);
        }
        $sort = $request->input('sort', 'recent');

        switch ($sort) {
            case 'recent':
                $query->orderBy('fecha_estreno_streaming', 'desc');
                break;
            case 'views':
                $query->orderBy('views_streaming', 'desc'); // Asumiendo que tienes esta columna
                break;
            case 'az':
                $query->orderBy('nombre_streaming', 'asc');
                break;
            case 'za':
                $query->orderBy('nombre_streaming', 'desc');
                break;
        }
        $streamings = $query->paginate(8);

        return view('client.catalogPage', compact('streamings', 'generos'));
    }

    public function detalle($id_streaming)
    {
        $streaming = TablaStreaming::where('estatus_streaming', 1)
            ->with('genero')
            ->findOrFail($id_streaming);
            
        return view('client.detalle-streaming', compact('streaming'));
    }
}
