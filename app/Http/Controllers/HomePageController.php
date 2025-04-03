<?php

namespace App\Http\Controllers;

use App\Models\TablaPlanes;
use App\Models\TablaStreaming;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function Home()
    {
        $title = "Inicio";

        $planes = TablaPlanes::where('estatus_plan', 1)->orderBy('precio_plan', 'asc')->get();

        $estreno = TablaStreaming::where('estatus_streaming', 1)
            ->orderBy('id_streaming', 'desc')
            ->first();

        $recientes = TablaStreaming::where('estatus_streaming', 1)
            ->where('id_streaming', '!=', $estreno ? $estreno->id_streaming : 0)
            ->orderBy('id_streaming', 'desc')
            ->take(4)
            ->get();

        if ($estreno) {
            $estreno->load('genero');
        }

        $recientes->load('genero');

        return view('client.homePage', compact('planes', 'estreno', 'recientes', 'title'));
    }
}
