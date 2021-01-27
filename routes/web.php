<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/library', [\App\Http\Controllers\LibraryController::class, 'index'])->name('dashboard');
    Route::get('/library/{library}/edit', [\App\Http\Controllers\LibraryController::class, 'show'])->name('library.edit');
    Route::patch('/library/{library}', [\App\Http\Controllers\LibraryController::class, 'update'])->name('library.update');
    Route::post('/library', [\App\Http\Controllers\LibraryController::class, 'store'])->name('library.store');
    Route::delete('/library/{library}', [\App\Http\Controllers\LibraryController::class, 'destroy'])->name('library.destroy');

    Route::post('/book', [\App\Http\Controllers\BookController::class, 'store'])->name('book.store');
    Route::get('/book/{book}/edit', [\App\Http\Controllers\BookController::class, 'edit'])->name('book.edit');
    Route::patch('/book/{book}', [\App\Http\Controllers\BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{book}', [\App\Http\Controllers\BookController::class, 'destroy'])->name('book.destroy');
});

require __DIR__ . '/auth.php';
