<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TablaUsuarios extends Authenticatable
{
    use \Illuminate\Notifications\Notifiable;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'estatus_usuario', 'nombre_usuario', 'ap_usuario','am_usuario', 'sexo_usuario', 
        'email_usuario', 'password_usuario', 'imagen_usuario', 'id_rol'
    ];

    // Relación con la tabla de planes
    public function planes()
    {
        return $this->hasMany(TablaUsuarios_Planes::class, 'id_usuario', 'id_usuario');
    }
    // Relación con la tabla de usuarios_planes
    public function usuariosPlanes()
    {
        return $this->hasMany(TablaUsuarios_Planes::class, 'id_usuario', 'id_usuario');
    }
    public function rol()
    {
        return $this->belongsTo(TablaRoles::class, 'id_rol');
    }

    // Relación con la tabla de géneros
    public function genero()
    {
        return $this->belongsTo(TablaGeneros::class, 'id_genero');
    }

    public function getAuthPassword()
    {
        return $this->password_usuario;
    }
}
