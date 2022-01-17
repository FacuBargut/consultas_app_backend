<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// //Entidad usuario
 Route::get('/usuarios', [UserController::class, 'index'] )->middleware('auth:api'); //Mostrar todos los usuarios
// Route::get('/usuarios/alumnos', [UserController::class, 'getAlumnos'] ); //Mostrar todos los alumnos
 Route::get('/usuarios/docentes', [UserController::class, 'getDocentes'] ); //Mostrar todos los docentes
 Route::get('/usuarios/alumnos', [UserController::class, 'getAlumnos'] ); //Mostrar todos los docentes
 Route::post('/usuarios', [UserController::class, 'store'] ); //Crear un usuario
 Route::put('/usuarios/{id}', [UserController::class, 'update'] ); //Actualizar un usuario
 Route::delete('/usuarios/{id}', [UserController::class, 'delete'] ); //Eliminar un usuario

// //Entidad consulta
Route::get('/consultas', [ConsultaController::class, 'index'] ); //Mostrar todas las consultas
Route::post('/consultas', [ConsultaController::class, 'grabar'] ); //Crear consultas
// Route::put('/consultas/{id}', [ConsultaController::class, 'update'] ); //Actualizar una consulta
// Route::delete('/consultas/{id}', [ConsultaController::class, 'delete'] ); //Eliminar una consulta

Route::prefix('/user')->group(function(){
    Route::post('/auth',[AuthController::class, 'auth']);
    Route::post('/login',[AuthController::class, 'login']);
});
