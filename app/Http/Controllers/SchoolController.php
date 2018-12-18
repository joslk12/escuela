<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Materia;
use App\Calificacion;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SchoolController extends Controller
{
    public function setCalification(Request $request) {
        $validator = Validator::make($request->all(), [
            'alumno' => 'required|numeric',
            'calificacion' => 'required|numeric',
            'materia' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json(['success' => 'no', 'msg' => $validator->errors()->toJson()], 400);
        }

        $alumno = Alumno::find($request->alumno);
        $materia = Materia::find($request->materia);
        if (! $alumno) {
            return response()->json(['success' => 'no', 'msg' => 'No existe el alumno'], 400);
        } 
        if (! $materia) {
            return response()->json(['success' => 'no', 'msg' => 'No existe la materia'], 400);
        }
        
        $calificacion = Calificacion::where('id_t_materias', $request->materia)->where('id_t_usuarios', $request->alumno)->first();
        if ($calificacion) {
            return response()->json(['success' => 'no', 'msg' => 'Ya se asigno calificacion a la materia'], 400);
        }
        $calificacion = new Calificacion();
        $calificacion->id_t_materias = $request->materia;
        $calificacion->id_t_usuarios = $request->alumno;
        $calificacion->calificacion = $request->calificacion;
        $calificacion->fecha_registro = Carbon::now();
        $calificacion->save();

        if ($calificacion->id_t_calificaciones != null) {
            return response()->json(['success' => 'ok', 'msg' => 'Calificacion registrada'], 400);
        }
        return response()->json(['success' => 'no', 'msg' => 'Error al guardar en base de datos'], 400);
    }

    public function getCalifications($alumno) {
        if (! is_numeric($alumno)) {
            return response()->json(['success' => 'no', 'msg' => 'Alumno no valido'], 400);
        }

        $alumno = Alumno::find($alumno);
        if (! $alumno) {
            return response()->json(['success' => 'no', 'msg' => 'No existe el alumno'], 400);
        } 
        
        $response = [];
        $prom = 0;

        if (sizeof($alumno->califications) == 0) {
            return response()->json(['success' => 'no', 'msg' => 'Alumno sin calificaciones'], 400);
        }
        
        foreach ($alumno->califications as $calification) {
            $calificacion['id_t_usuario'] = $alumno->id_t_usuarios;
            $calificacion['nombre'] = $alumno->nombre;
            $calificacion['apellido'] = $alumno->ap_paterno;
            $calificacion['materia'] = $calification->matter->nombre;
            $calificacion['calificacion'] = $calification->calificacion;
            $calificacion['fecha_registro'] = $calification->fecha_registro;
            $prom = $prom + $calification->calificacion;
            $response[] = $calificacion;
        }

        $prom = $prom / sizeof($alumno->califications);
        $response[] = ['promedio' => $prom];

        return response()->json($response, 200);

    }

    public function updateCalification(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_t_calificaciones' => 'required|numeric',
            'calificacion' => 'required|numeric',
        ]);

        $calification = Calificacion::find($request->id_t_calificaciones);

        if(! $calification) {
            return response()->json(['success' => 'no', 'msg' => 'No existe calificación'], 400);
        }

        $calification->calificacion = $request->calificacion;
        $calification->fecha_registro = Carbon::now();
        $calification->save();
        return response()->json(['success' => 'ok', 'msg' => 'Calificacion actializada'], 200);
    }

    public function deleteCalification($calificacion) {
        if (! is_numeric($calificacion)) {
            return response()->json(['success' => 'no', 'msg' => 'Id de calificacion no valido'], 400);
        }

        $calification = Calificacion::find($calificacion);
        if(! $calificacion) {
            return response()->json(['success' => 'no', 'msg' => 'No existe calificación'], 400);
        }

        $calification->delete();
        return response()->json(['success' => 'ok', 'msg' => 'Calificacion eliminada'], 200);
    }
}
