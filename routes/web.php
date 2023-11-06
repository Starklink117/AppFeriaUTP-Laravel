<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\JuradoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PreguntaController; 
use App\Http\Controllers\CalificarController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::group(['middleware' => ['auth']], function () {
    //Rutas protegidas
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('divisiones', DivisionController::class);
    Route::resource('participantes', ParticipanteController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('proyectos', ProyectoController::class);
    Route::resource('jurados', JuradoController::class);
    Route::resource('preguntas', PreguntaController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('calificaciones', CalificacionController::class);
    Route::get('/calificar/{id_proyecto}', [CalificarController::class, 'show'])->name('calificar_proyecto');;
    Route::post('/calificar/{id_proyecto}', [CalificarController::class, 'store'])->name('calificar.store');


});