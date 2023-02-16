<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crearusuarios;
use App\Http\Controllers\AcesoController;
use App\Http\Controllers\backend\CuestionarioController;
use App\Http\Controllers\backend\DocenteguiaController;
use App\Http\Controllers\backend\DocentetutorController;
use App\Http\Controllers\backend\EstudiantesController;
use App\Http\Controllers\backend\EvaluarpracticasController;
use App\Http\Controllers\backend\MispracticasController;
use App\Http\Controllers\backend\PerfilController;
use App\Http\Controllers\backend\PlandepracticasController;
use App\Http\Controllers\backend\PracticasController;
use App\Http\Controllers\backend\VariablevaloracionesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{id}/savehestudiante', [PerfilController::class, 'savehestudiante']);
/*Perfil */
Route::resource('/perfil', PerfilController::class)->names('perfil');
Route::get('/perfil/{id}/obtenerprovincia', [PerfilController::class, 'obtenerprovincia']);
Route::get('/perfil/{id}/obtenerdistrito', [PerfilController::class, 'obtenerdistrito']);
/*Crearusuario */
Route::resource('/crearusuarios', Crearusuarios::class)->names('crearusuarios');
Route::post('/crearusuarios/{id}/validarcorreo', [Crearusuarios::class, 'validarcorreo'])->name('validarcorreo');
/*Acceso */
Route::resource('/accesos', AcesoController::class)->names('accesos');
Route::post('/accesos/{id}/acceder', [AcesoController::class, 'acceder'])->name('acceder');
/*Estudiantes */
Route::resource('/estudiantes', EstudiantesController::class)->names('estudiantes');
Route::post('/estudiantes/{id}/guardar', [EstudiantesController::class, 'guardar']);
Route::post('/estudiantes/{id}/autocompetarestudiante', [EstudiantesController::class, 'autocompetarestudiante'])->name('autocompetarestudiante');
/*Docente guia */
Route::resource('/docentesguias', DocenteguiaController::class)->names('docentesguias');
Route::post('/docentesguias/{id}/guardar', [DocenteguiaController::class, 'guardar']);
/*Docente tutor */
Route::resource('/docentestutores', DocentetutorController::class)->names('docentestutores');
Route::post('/docentestutores/{id}/guardar', [DocentetutorController::class, 'guardar']);
Route::post('/docentestutores/{id}/autocompetartutor', [DocentetutorController::class, 'autocompetartutor'])->name('autocompetartutor');
Route::post('/docentestutores/{id}/guardar', [DocentetutorController::class, 'guardar']);
/*Plan Practicas */
Route::resource('/practicas', PracticasController::class)->names('practicas');
Route::post('/practicas/{id}/savepracticas', [PracticasController::class, 'savepracticas'])->name('savepracticas');
Route::post('/practicas/{id}/savecronopracticas', [PracticasController::class, 'savecronopracticas'])->name('savecronopracticas');
/*Plan practicas */
Route::resource('/planpracticas', PlandepracticasController::class)->names('planpracticas');
/*Mis practicas */
Route::resource('/mispracticas', MispracticasController::class)->names('mispracticas');
/*Evaluar practicas */
Route::resource('/evaluarpracticas', EvaluarpracticasController::class)->names('evaluarpracticas');
/*Cuestionario */
Route::resource('/cuestionarios', CuestionarioController::class)->names('cuestionarios');
/*Variablevaloraciones */
Route::resource('/variablevaloraciones', VariablevaloracionesController::class)->names('variablevaloraciones');