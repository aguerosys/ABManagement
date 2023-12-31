<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function(){

    Route::prefix('producto')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('crear', [ProductController::class, 'store'])->name('product.store');
        Route::delete('eliminar/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('modificar/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('modificar/{product}', [ProductController::class, 'amountUpdate'])->name('product.amountUpdate');
        Route::post('modificar-general/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::get('agregar/{product}', [ProductController::class, 'viewAmount'])->name('product.viewAmount');
        Route::post('agregar/{product}', [ProductController::class, 'addAmount'])->name('product.addAmount');
    });
});

Route::get('/', function(){
    return view('main');
})->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


//reports

Route::get('reports/', [ReportController::class, 'index'])->name('reports.index')->middleware('auth');


//repairs 
Route::get('reparacion/', [RepairController::class, 'index'])->name('repair.index')->middleware('auth');
Route::post('reparacion/crear', [RepairController::class, 'store'])->name('repair.store')->middleware('auth');
Route::delete('reparacion/eliminar/{repair}', [RepairController::class, 'destroy'])->name('repair.destroy')->middleware('auth');
Route::get('reparacion/modificar-estado-terminado/{repair}', [RepairController::class, 'doneState'])->name('repair.doneState')->middleware('auth');
Route::get('reparacion/modificar-estado-en-proceso/{repair}', [RepairController::class, 'processState'])->name('repair.processState')->middleware('auth');
Route::get('reparacion/modificar-estado-pendiente/{repair}', [RepairController::class, 'pendingState'])->name('repair.pendingState')->middleware('auth');


//client
Route::get('clientes/', [ClientController::class, 'index'])->name('client.index')->middleware('auth');
Route::post('clientes/crear', [ClientController::class, 'store'])->name('client.store')->middleware('auth');
Route::delete('clientes/eliminar/{client}', [ClientController::class, 'destroy'])->name('client.destroy')->middleware('auth');


//export
Route::get('producto/exportar', [ProductController::class, 'exportPDF'])->name('product.export')->middleware('auth');