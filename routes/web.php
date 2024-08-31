<?php

use App\Http\Controllers\admin\RegisteruserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function () {
    Route::get('/register',[RegisteredUserController::class, 'create'])->name('adminregister');
    Route::post('/register',[RegisteredUserController::class, 'store'])->name('adminregister.store');

    Route::get('/registeruser',[RegisteruserController::class, 'show'])->name('registeruser.show');
    Route::post('/registeruser',[RegisteruserController::class, 'store'])->name('registeruser.store');

})->middleware(['role:admin','auth']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
