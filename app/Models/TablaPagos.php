<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaPagos extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';
    public $timestamps = false;

    protected $fillable = [
        'fecha_registro_pago', 'estatus_pago', 'monto_pago', 'tarjeta_pago', 'id_usuario', 'id_plan'
    ];
    // Define la relación con la tabla de usuarios
    public function usuario()
    {
        return $this->belongsTo(TablaUsuarios::class, 'id_usuario', 'id_usuario');
    }
    // Define la relación con la tabla de planes
    public function plan()
    {
        return $this->belongsTo(TablaPlanes::class, 'id_plan', 'id_plan');
    }
    // Define la relación con la tabla de streaming
    public function streaming()
    {
        return $this->belongsTo(TablaStreaming::class, 'id_streaming', 'id_streaming');
    }
    // Define la relación con la tabla de alquileres
    public function alquiler()
    {
        return $this->hasMany(TablaAlquileres::class, 'id_alquiler', 'id_alquiler');
    }
    // Define la relación con la tabla de usuarios_planes
    public function usuariosPlanes()
    {
        return $this->hasMany(TablaUsuarios_Planes::class, 'id_usuario_plan', 'id_usuario_plan');
    }
    // Define la relación con la tabla de videos
    public function videos()
    {
        return $this->hasMany(TablaVideos::class, 'id_video', 'id_video');
    }
    // Define la relación con la tabla de generos
    public function generos()
    {
        return $this->hasMany(TablaGeneros::class, 'id_genero', 'id_genero');
    }
    // Define la relación con la tabla de streaming_planes
    public function streamingPlanes()
    {
        return $this->hasMany(TablaStreaming::class, 'id_streaming', 'id_streaming');
    }
    // Define la relación con la tabla de planes_streaming
    public function planesStreaming()
    {
        return $this->hasMany(TablaPlanes::class, 'id_plan', 'id_plan');
    }
    // Define la relación con la tabla de streaming_pagos
    public function streamingPagos()
    {
        return $this->hasMany(TablaStreaming::class, 'id_streaming', 'id_streaming');
    }
    // Define la relación con la tabla de planes_pagos
    public function planesPagos()
    {
        return $this->hasMany(TablaPlanes::class, 'id_plan', 'id_plan');
    }
    // Define la relación con la tabla de usuarios_planes_pagos
    public function usuariosPlanesPagos()
    {
        return $this->hasMany(TablaUsuarios_Planes::class, 'id_usuario_plan', 'id_usuario_plan');
    }
    // Define la relación con la tabla de usuarios_planes_streaming
    public function usuariosPlanesStreaming()
    {
        return $this->hasMany(TablaUsuarios_Planes::class, 'id_usuario_plan', 'id_usuario_plan');
    }
}
