<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 't_alumnos';

    protected $primaryKey = 'id_t_usuarios';

    protected $fillable = [
        'id_t_usuarios', 'nombre', 'ap_paterno', 'ap_materno', 'activo',
    ];

    public $timestamps = false;

    public function califications() {
        return $this->hasMany('App\Calificacion', 'id_t_usuarios');
    }
}
