<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaStreaming extends Model
{
    protected $table = 'streaming';
    protected $primaryKey = 'id_streaming';
    public $timestamps = false;

    protected $fillable = [
        'estatus_streaming', 'nombre_streaming', 'fecha_lanzamiento_streaming', 'duracion_streaming', 'temporadas_streaming', 'caratula_streaming',
        'trailer_streaming', 'clasificacion_streaming', 'sipnosis_streaming', 'fecha_estreno_streaming', 'id_genero'
    ];

    public function genero()
    {
        return $this->belongsTo(TablaGeneros::class, 'id_genero', 'id_genero');
    }
    public function videos()
    {
        return $this->hasMany(TablaVideos::class, 'id_streaming', 'id_streaming');
    }
    public function planes()
    {
        return $this->belongsToMany(TablaPlanes::class, 'planes_streaming', 'id_streaming', 'id_plan');
    }
    public function pagos()
    {
        return $this->hasMany(TablaPagos::class, 'id_plan', 'id_plan');
    }
    
}
