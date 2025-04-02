<?php


namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TablaGeneros as Generos;
use App\Models\TablaPlanes as Planes;
use App\Models\TablaStreaming as Streaming;
use App\Models\TablaUsuarios as Usuarios;
use App\Models\TablaVideos as Videos;
use App\Models\TablaRoles as Roles;


class TableroController extends Controller
{
    public function index(){
        $usuarios = Usuarios::all();
        $roles= Roles::all();
        $generos = Generos::paginate(4);
        $planes = Planes::all();
        $streamings = Streaming::all();
        $videos = Videos::join('streaming', 'streaming.id_streaming', '=', 'videos.id_streaming')->select('videos.*', 'streaming.*')->get();
        // Pasar los datos a la vista
        return view('admon.home');
    }
}
