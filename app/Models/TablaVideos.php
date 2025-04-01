<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaVideos extends Model
{
    protected $table = 'videos';
    protected $primaryKey = 'id_video';
    public $timestamps = false;

    protected $fillable = [
        'estatus_video', 'video', 'nombre_temporada', 'video_temporada', 'capitulo_temporada', 'descripcion_capitulo_temporada','id_streaming'
    ];
    public function streaming()
    {
        return $this->belongsTo(TablaStreaming::class, 'id_streaming', 'id_streaming');
    }

}
