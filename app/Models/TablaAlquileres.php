<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaAlquileres extends Model
{
    protected $table = 'alquileres';
    protected $primaryKey = 'id_alquiler';
    public $timestamps = false;

    protected $fillable = [
        'fecha_inicio_alquiler', 'fecha_fin_alquiler', 'estatus_alquiler', 'id_streaming', 'id_usuario'
    ];

    // Define any relationships or additional methods here
    public function streaming()
    {
        return $this->belongsTo(TablaStreaming::class, 'id_streaming', 'id_streaming');
    }
    public function usuario()
    {
        return $this->belongsTo(TablaUsuarios::class, 'id_usuario', 'id_usuario');
    }
    public function pagos()
    {
        return $this->hasMany(TablaPagos::class, 'id_pago', 'id_pago');
    }
    public function videos()
    {
        return $this->hasMany(TablaVideos::class, 'id_video', 'id_video');
    }
    public function generos()
    {
        return $this->hasMany(TablaGeneros::class, 'id_genero', 'id_genero');
    }
    public function planes()
    {
        return $this->hasMany(TablaPlanes::class, 'id_plan', 'id_plan');
    }
}
