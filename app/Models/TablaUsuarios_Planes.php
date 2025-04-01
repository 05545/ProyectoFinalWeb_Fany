<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaUsuarios_Planes extends Model
{
    protected $table = 'usuarios_planes';
    protected $primaryKey = 'id_usuario_plan';
    public $timestamps = false;

    protected $fillable = [
        'fecha_registro_plan', 'fecha_fin_plan', 'id_usuario', 'id_plan'
    ];

    // define la relación con la tabla de usuarios
    public function usuario()
    {
        return $this->belongsTo(TablaUsuarios::class, 'id_usuario', 'id_usuario');
    }

    // define la relacion de la tabla de planes
    public function plan()
    {
        return $this->belongsTo(TablaPlanes::class, 'id_plan', 'id_plan');
    }
}
