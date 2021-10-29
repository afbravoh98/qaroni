<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;

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

Route::get('events', [EventController::class, 'index'])->name('events');
Route::post('events', [EventController::class, 'store'])->name('events.store');
Route::get('events/{slug}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('events/{slug}', [EventController::class, 'update'])->name('events.update');
Route::delete('events/{slug}/delete', [EventController::class, 'destroy'])->name('events.delete');


Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{slug}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{slug}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');




