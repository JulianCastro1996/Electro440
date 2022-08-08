<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanillaController;

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


//Auth::routes();
Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::get('planilla/listado/{pag?}', [PlanillaController::class,'mostrarListaPlanilla'])->name('listado')->middleware('auth');
Route::get('/planilla/nueva', [PlanillaController::class,'create'])->middleware('auth')->middleware('auth');
Route::post('/planilla/store',[PlanillaController::class,'store'])->name('createPlanilla')->middleware('auth');
Route::get('/planilla/{planillaID}', [PlanillaController::class,'mostrarPlanilla'])->name('planilla')->middleware('auth');
Route::post('/planilla/presupuestar', [PlanillaController::class,'presupuestar'])->name('presupPlanilla')->middleware('auth');
Route::get('/planilla/borrar/{id}',[PlanillaController::class,'deletePlanilla'])->name('deletePlanilla')->middleware('auth');