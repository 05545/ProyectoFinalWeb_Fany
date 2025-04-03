<?php

namespace App\Http\Controllers;

use App\Models\TablaAlquileres;
use App\Models\TablaStreaming;
use App\Models\TablaVideos;
use Auth;
use Illuminate\Http\Request;

class StreamingPublicController extends Controller
{
    public function streaming()
    {
        $userId = Auth::user()->id_usuario;

        $alquileres = TablaAlquileres::where('id_usuario', $userId)
            ->where('estatus_alquiler', -1)
            ->get();

        $streamings = [];
        foreach ($alquileres as $alquiler) {
            $streaming = TablaStreaming::find($alquiler->id_streaming);
            if ($streaming) {
                $fechaFin = strtotime($alquiler->fecha_fin_alquiler);
                $ahora = time();
                $horasRestantes = max(0, round(($fechaFin - $ahora) / 3600));

                $streaming->horas_restantes = $horasRestantes;
                $streaming->id_alquiler = $alquiler->id_alquiler;
                $streamings[] = $streaming;
            }
        }

        return view('client.streaming', compact('streamings'));
    }

    public function detalleStreaming($id_streaming)
    {
        $userId = Auth::user()->id_usuario;
        $streaming = TablaStreaming::with('genero')->findOrFail($id_streaming);

        $alquiler = TablaAlquileres::where('id_usuario', $userId)
            ->where('id_streaming', $id_streaming)
            ->where('estatus_alquiler', -1)
            ->first();

        $horasRestantes = 0;
        $alquilado = false;
        $id_alquiler = null;

        if ($alquiler) {
            $fechaFin = strtotime($alquiler->fecha_fin_alquiler);
            $ahora = time();
            $horasRestantes = max(0, round(($fechaFin - $ahora) / 3600));
            $alquilado = true;
            $id_alquiler = $alquiler->id_alquiler;
        }

        $videos = TablaVideos::where('id_streaming', $id_streaming)
            ->where('estatus_video', 1)
            ->orderBy('video_temporada')
            ->orderBy('capitulo_temporada')
            ->get();

        return view('client.detalleStreaming', compact(
            'streaming',
            'horasRestantes',
            'alquilado',
            'videos',
            'id_alquiler'
        ));
    }
}
