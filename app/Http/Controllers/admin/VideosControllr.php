<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TablaStreaming as Streaming;
use App\Models\TablaGeneros as Generos;
use App\Models\TablaVideos as Videos;

class VideosControllr extends Controller
{
    public function index()
    {
        $generos = Generos::all();
        $streamings = Streaming::all();
        $videos = Videos::select('s.*', 'videos.*')
            ->join('streaming as s', 's.id_streaming', '=', 'videos.id_streaming')
            ->where('videos.nombre_temporada', null)
            ->get();

        return view('admon.movies', compact('generos', 'streamings', 'videos'));
    }

    public function store(Request $request){
        //  dd($request->all());
          $request->validate([
              'nombre_streaming' => 'required|string|max:255',
              'fecha_lanzamiento_streaming' => 'required|date',
              'temporadas_streaming' => 'nullable',
              'caratula_streaming' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
              'trailer_streaming' => 'required|mimes:mp4,mov,avi,wmv',
              'clasificacion_streaming' => 'required|string',
              'sipnosis_streaming' => 'nullable|string',
              'fecha_estreno_streaming' => 'required|date',
              'id_genero' => 'required|exists:generos,id_genero',
              'estatus_streaming' => 'required|in:1,0',
          ]);
         // dd($request->all());
          $streaming = new Streaming();
          $streaming->nombre_streaming = $request->nombre_streaming;
          $streaming->fecha_lanzamiento_streaming = $request->fecha_lanzamiento_streaming;
          $streaming->duracion_streaming = $request->duracion_streaming;
          $streaming->temporadas_streaming = $request->temporadas_streaming;
          $streaming->clasificacion_streaming = $request->clasificacion_streaming;
          $streaming->sipnosis_streaming = $request->sipnosis_streaming;
          $streaming->fecha_estreno_streaming = $request->fecha_estreno_streaming;
          $streaming->id_genero = $request->id_genero;
          $streaming->estatus_streaming = $request->estatus_streaming;
  
          if ($request->hasFile('caratula_streaming')) {
              $file = $request->file('caratula_streaming');
              $filename = time() . '.' . $file->getClientOriginalExtension();
              $file->move(public_path('Peliculas/imagen'), $filename);
              $streaming->caratula_streaming = $filename;
          }
  
          if ($request->hasFile('trailer_streaming')) {
              $file = $request->file('trailer_streaming');
              $filename = time() . '.' . $file->getClientOriginalExtension();
              $file->move(public_path('Peliculas/videos'), $filename);
              $streaming->trailer_streaming = $filename;
          }
  
          $streaming->save();
  
          return redirect()->route('admin.streaming')->with('success', 'Streaming creado exitosamente.');
      }
  
      public function update(Request $request, $id){
         //  dd($request->all());
          $request->validate([
              'modal_nombre_streaming' => 'required|string|max:255',
              'modal_fecha_lanzamiento_streaming' => 'required|date',
              'modal_duracion_streaming' => 'nullable',
              'modal_temporadas_streaming' => 'nullable',
              'modal_caratula_streaming' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
              'modal_trailer_streaming' => 'nullable|mimes:mp4,mov,avi,wmv',
              'modal_clasificacion_streaming' => 'required',
              'modal_sipnosis_streaming' => 'nullable',
              'modal_fecha_estreno_streaming' => 'required|date',
              'modal_id_genero' => 'required|exists:generos,id_genero',
              'modal_estatus_streaming' => 'required|in:1,0',
          ]);
  
       
          $streaming = Streaming::findOrFail($id);
          $streaming->nombre_streaming = $request->modal_nombre_streaming;
          $streaming->fecha_lanzamiento_streaming = $request->modal_fecha_lanzamiento_streaming;
          $streaming->duracion_streaming = $request->modal_duracion_streaming;
          $streaming->temporadas_streaming = $request->modal_temporadas_streaming;
          $streaming->clasificacion_streaming = $request->modal_clasificacion_streaming;
          $streaming->sipnosis_streaming = $request->modal_sipnosis_streaming;
          $streaming->fecha_estreno_streaming = $request->modal_fecha_estreno_streaming;
          $streaming->id_genero = $request->modal_id_genero;
          $streaming->estatus_streaming = $request->modal_estatus_streaming;
  
          if ($request->hasFile('modal_caratula_streaming')) {
              // Eliminar la imagen anterior si existe
              if ($streaming->caratula_streaming && file_exists(public_path('Peliculas/imagen/' . $streaming->caratula_streaming))) {
                  unlink(public_path('Peliculas/imagen/' . $streaming->caratula_streaming));
              }
              // Subir la nueva imagen
              $file = $request->file('modal_caratula_streaming');
              $filename = time() . '.' . $file->getClientOriginalExtension();
              $file->move(public_path('Peliculas/imagen/'), $filename);
              $streaming->caratula_streaming = $filename;
          }
  
          if ($request->hasFile('modal_trailer_streaming')) {
              // Eliminar el video anterior si existe
              if ($streaming->trailer_streaming && file_exists(public_path('Peliculas/videos/' . $streaming->trailer_streaming))) {
                  unlink(public_path('Peliculas/videos/' . $streaming->trailer_streaming));
              }
              // Subir el nuevo video
              $file = $request->file('modal_trailer_streaming');
              $filename = time() . '.' . $file->getClientOriginalExtension();
              $file->move(public_path('Peliculas/videos/'), $filename);
              $streaming->trailer_streaming = $filename;
          }
        //  dd($streaming);
          $streaming->save();
          return redirect()->route('admin.tablero')->with('success', 'Streaming actualizado exitosamente.');
      }
  
      public function destroy($id)
      {
          $streaming = Streaming::findOrFail($id);
      
          // Eliminar la carátula si existe
          if ($streaming->caratula_streaming && file_exists(public_path('Peliculas/imagen/' . $streaming->caratula_streaming))) {
              unlink(public_path('Peliculas/imagen/' . $streaming->caratula_streaming));
          }
      
          // Eliminar el trailer si existe
          if ($streaming->trailer_streaming && file_exists(public_path('Peliculas/videos/' . $streaming->trailer_streaming))) {
              unlink(public_path('Peliculas/videos/' . $streaming->trailer_streaming));
          }
      
          // Eliminar el registro de la base de datos
          $streaming->delete();
      
          return redirect()->route('admin.tablero')->with('success', 'Streaming eliminado exitosamente.');
      }
      
      //CRUD de videos

      public function store_videos(Request $request){
        $request->validate([
            'video' => 'required|string|max:255',
            'nombre_temporada' => 'nullable|string',
            'video_temporada' => 'nullable|integer',
            'capitulo_temporada' => 'nullable|integer',
            'descripcion_capitulo_temporada' => 'nullable|string',
            'id_streaming' => 'required|exists:streaming,id_streaming',
            'estatus_video' => 'required|in:1,0',
        ]);

        $video = new Videos();
        $video->video = $request->video;
        $video->nombre_temporada = $request->nombre_temporada;
        $video->video_temporada = $request->video_temporada;
        $video->capitulo_temporada = $request->capitulo_temporada;
        $video->descripcion_capitulo_temporada = $request->descripcion_capitulo_temporada;
        $video->id_streaming = $request->id_streaming;
        $video->estatus_video = $request->estatus_video;
        // Guardar el archivo de video
        $video->save();

        return redirect()->route('admin.usuarios')->with('success', 'Video creado correctamente');
    }

    public function update_videos(Request $request, $id){
        $request->validate([
            'modal_video' => 'required|string|max:255',
            'modal_nombre_temporada' => 'nullable|string',
            'modal_video_temporada' => 'required|integer',
            'modal_capitulo_temporada' => 'nullable|integer',
            'modal_descripcion_capitulo_temporada' => 'nullable|string',
            'modal_id_streaming' => 'required|exists:streaming,id_streaming',
            'modal_estatus_video' => 'required|in:1,0',
        ]);

        $video = Videos::findOrFail($id);
        $video->video = $request->modal_video;
        $video->nombre_temporada = $request->modal_nombre_temporada;
        $video->video_temporada = $request->modal_video_temporada;
        $video->capitulo_temporada = $request->modal_capitulo_temporada;
        $video->descripcion_capitulo_temporada = $request->modal_descripcion_capitulo_temporada;
        $video->id_streaming = $request->modal_id_streaming;
        $video->estatus_video = $request->modal_estatus_video;
        // Guardar el archivo de video
        $video->save();

        return redirect()->route('admin.tablero')->with('success', 'Video actualizado correctamente');
    }
    public function destroy_videos($id){
        $video = Videos::findOrFail($id);
        $video->delete();
        return redirect()->route('admin.tablero')->with('success', 'Video eliminado correctamente');
    }
  

}
