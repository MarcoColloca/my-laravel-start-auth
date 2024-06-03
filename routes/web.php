<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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



Route::middleware(['auth', 'verified'])
->name('admin.') // il prefisso che viene aggiunto a tutti i NOMI delle rotte nel gruppo
->prefix('admin') // il prefisso che viene aggiunto a tutti gli URL delle rotte nel gruppo
->group(function() {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Registrare tutte le altre rotte protette. Nel nostro caso aggiungeremo la CRUD sui POSTS
    
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
