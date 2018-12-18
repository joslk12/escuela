<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 't_materias';

    protected $primaryKey = 'id_t_materias';

    protected $fillable = [
        'id_t_materias', 'nombre', 'activo',
    ];

    public $timestamps = false;

    public function califications() {
        return $this->hasMany('App\Calificacion', 'id_t_materias');
    } 
}
