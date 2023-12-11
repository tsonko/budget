<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntriesController;
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

Route::get('/entries', [EntriesController::class,'index'])->name('entries.index');
Route::post('/entries/create', [EntriesController::class,'create'])->name('entries.create');
Route::post('/entries/update', [EntriesController::class,'update'])->name('entries.update');
