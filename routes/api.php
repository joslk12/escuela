<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/registrarCalificacion', 'SchoolController@setCalification');
    Route::get('/obtenerCalificacion/{alumno}', 'SchoolController@getCalifications');
    Route::put('/actualizaCalificacion', 'SchoolController@updateCalification');
    Route::delete('/borrarCalificacion/{calificacion}', 'SchoolController@deleteCalification');
});