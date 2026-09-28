<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComputerController;

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

Route::resource('area', AreaController::class);

Route::get('area/list', [AreaController::class, 'index'])->name('area.index');
Route::get('area/show/{id}',[AreaController::class,'show'])->name('area.show');

Route::get('computer/list', [ComputerController::class, 'index'])->name('computer.index');
Route::get('computer/show/{id}',[ComputerController::class,'show'])->name('computer.show');
