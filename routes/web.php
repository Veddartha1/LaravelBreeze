<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GangaController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [GangaController::class,'index'])->name('index');

Route::get('/latest', [GangaController::class,'latest'])->name('latest');
Route::get('/featured', [GangaController::class,'featured'])->name('featured');
Route::get('/owned', [GangaController::class,'owned'])->name('owned');

Route::put('/like/{id}', [GangaController::class, 'like'])->name('gangas.like');
Route::put('/unlike/{id}', [GangaController::class, 'unlike'])->name('gangas.unlike');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('gangas', GangaController::class);
Route::resource('categorias', CategoryController::class);

require __DIR__.'/auth.php';
