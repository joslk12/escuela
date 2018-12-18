<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 't_calificaciones';

    protected $primaryKey = 'id_t_calificaciones';

    protected $fillable = [
        'id_t_calificaciones', 'id_t_materias', 'id_t_usuarios', 'calificacion', 'fecha_registro',
    ];

    public $timestamps = false;

    public function matter() {
        return $this->belongsTo('App\Materia', 'id_t_materias');
    }

    public function student() {
        return $this->belongsTo('App\Alumno', 'id_t_usuarios', 'id_t_usuarios');
    }
}
