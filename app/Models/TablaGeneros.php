<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaGeneros extends Model
{
    protected $table = 'generos';
    protected $primaryKey = 'id_genero';
    public $timestamps = false;

    protected $fillable = [
        'estatus_genero', 'nombre_genero', 'descripcion_genero',
    ];
    public function videos()
    {
        return $this->hasMany(TablaVideos::class, 'id_video', 'id_video');
    }
    public function streaming()
    {
        return $this->hasMany(TablaStreaming::class, 'id_streaming', 'id_streaming');
    }
    public function planes()
    {
        return $this->hasMany(TablaPlanes::class, 'id_plan', 'id_plan');
    }

    public function streamings()
    {
        return $this->hasMany(TablaStreaming::class, 'id_genero', 'id_genero');
    }
}
