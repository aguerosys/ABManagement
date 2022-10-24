<?php

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

Route::get('/', function(){
    return view('main');
})->middleware('auth');

Route::get('producto/', [ProductController::class, 'index'])->name('product.index')->middleware('auth');

Route::post('producto/crear', [ProductController::class, 'store'])->name('product.store')->middleware('auth');
Route::delete('producto/eliminar/{product}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('auth');
Route::get('producto/modificar/{product}', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::post('producto/modificar/{product}', [ProductController::class, 'amountUpdate'])->name('product.amountUpdate')->middleware('auth');
Route::post('producto/modificar-general/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('auth');
Route::get('producto/agregar/{product}', [ProductController::class, 'viewAmount'])->name('product.viewAmount')->middleware('auth');
Route::post('producto/agregar/{product}', [ProductController::class, 'addAmount'])->name('product.addAmount')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


//reports

Route::get('reports/', [ReportController::class, 'index'])->name('reports.index')->middleware('auth');


//repairs 
Route::get('reparacion/', [RepairController::class, 'index'])->name('repair.index')->middleware('auth');
Route::post('reparacion/crear', [RepairController::class, 'store'])->name('repair.store')->middleware('auth');

//export
Route::get('producto/exportar', [ProductController::class, 'exportPDF'])->name('product.export')->middleware('auth');