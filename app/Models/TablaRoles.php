<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablaRoles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    public $timestamps = false;

    protected $fillable = [
        'nombre_rol', 
    ];

    public function usuarios()
    {
        return $this->hasMany(TablaUsuarios::class, 'id_rol', 'id_rol');
    }
   
}
