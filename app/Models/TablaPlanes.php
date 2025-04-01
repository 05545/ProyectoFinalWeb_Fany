<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaPlanes extends Model
{
    protected $table = 'planes';
    protected $primaryKey = 'id_plan';
    public $timestamps = false;

    protected $fillable = [
        'estatus_plan', 'nombre_plan', 'precio_plan', 'cantidad_limite_plan', 'tipo_plan',
    ];
    public function pagos()
    {
        return $this->hasMany(TablaPagos::class, 'id_plan', 'id_plan');
    }
    public function streaming()
    {
        return $this->belongsToMany(TablaStreaming::class, 'planes_streaming', 'id_plan', 'id_streaming');
    }
    public function videos()
    {
        return $this->hasMany(TablaVideos::class, 'id_video', 'id_video');
    }
    public function generos()
    {
        return $this->hasMany(TablaGeneros::class, 'id_genero', 'id_genero');
    }
    public function streamingPagos()
    {
        return $this->hasMany(TablaStreaming::class, 'id_streaming', 'id_streaming');
    }
    public function planesPagos()
    {
        return $this->hasMany(TablaPagos::class, 'id_plan', 'id_plan');
    }
    public function planesStreaming()
    {
        return $this->hasMany(TablaStreaming::class, 'id_streaming', 'id_streaming');
    }
}
