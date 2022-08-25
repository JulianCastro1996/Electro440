<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\EstadosController;

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
    return redirect('/login');
});


Auth::routes();
//Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/buscar', [App\Http\Controllers\PlanillaController::class, 'buscar'])->name('buscar');


Route::get('planilla/listado/{pag?}', [PlanillaController::class,'mostrarListaPlanilla'])->name('listado')->middleware('auth');
Route::get('/planilla/nueva', [PlanillaController::class,'create'])->middleware('auth')->middleware('auth');
Route::post('/planilla/store',[PlanillaController::class,'store'])->name('createPlanilla')->middleware('auth');
Route::get('/planilla/borrar/{id}',[PlanillaController::class,'deletePlanilla'])->name('deletePlanilla')->middleware('auth');
Route::get('/planilla/{planillaID}', [PlanillaController::class,'mostrarPlanilla'])->name('planilla')->middleware('auth');
Route::get('/planilla/editar/{planillaID}', [PlanillaController::class,'mostrarPlanilla'])->name('editarPlanilla')->middleware('auth');


Route::post('/estado/presupuestar', [EstadosController::class,'presupuestar'])->name('presupPlanilla')->middleware('auth');
Route::post('/estado/confirmar', [EstadosController::class,'confirmar'])->name('confirmarPlanilla')->middleware('auth');
Route::post('/estado/reparacion', [EstadosController::class,'reparacion'])->name('reparacionPlanilla')->middleware('auth');
Route::post('/estado/entrega', [EstadosController::class,'entrega'])->name('entregaPlanilla')->middleware('auth');


Route::post('/planilla/editar', [PlanillaController::class,'editarPlanilla'])->name('editarPlanilla')->middleware('auth');

Route::post('/estado/presupuesto/editar', [EstadosController::class,'editarPresupuesto'])->name('editarPresupuesto')->middleware('auth');
Route::post('/estado/confirmacion/editar', [EstadosController::class,'editarConfirmacion'])->name('editarConfirmacion')->middleware('auth');
Route::post('/estado/resultado/editar', [EstadosController::class,'editarResultado'])->name('editarResultado')->middleware('auth');
Route::post('/estado/entrega/editar', [EstadosController::class,'editarEntrega'])->name('editarEntrega')->middleware('auth');