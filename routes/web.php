<?php

use App\Http\Controllers\admin\RegisteruserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::prefix('admin')->group(function () {
    Route::get('/register',[RegisteredUserController::class, 'create'])->name('adminregister');
    Route::post('/register',[RegisteredUserController::class, 'store'])->name('adminregister.store');

    Route::get('/registeruser',[RegisteruserController::class, 'show'])->name('registeruser.show');
    Route::post('/registeruser',[RegisteruserController::class, 'store'])->name('registeruser.store');

})->middleware(['role:admin','auth']);

Route::prefix('dashboard')->group(function (){
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/newpost',[PostsController::class,'show'])->middleware('role:admin|editor|writer','auth')->name('newpost.show');
Route::post('/newpost',[PostsController::class,'store'])->middleware(['role:admin|editor|writer','auth'])->name('newpost.store');
Route::get('/editpost',[PostsController::class,'editpost'])->middleware(['role:admin|editor|writer','auth'])->name('editpost');
Route::post('/editpost',[PostsController::class,'editthepost'])->middleware(['role:admin|editor|writer','auth'])->name('editpost.do');
Route::get('/managecategories',[CategoryController::class,'show'])->middleware('role:admin|editor','auth')->name('managecats');
Route::post('/managecategories',[CategoryController::class,'action'])->middleware('role:admin|editor','auth')->name('cataction');
Route::get('/newpage',[PagesController::class,'show'])->middleware('role:editor|admin','auth')->name('newpage');
Route::post('/newpage',[PagesController::class,'store'])->middleware('role:editor|admin','auth')->name('newpage.store');
Route::get('/editpage',[PagesController::class,'editpage'])->middleware('role:editor|admin','auth')->name('editpage');
Route::post('/editpage',[PagesController::class,'editthepage'])->middleware('role:editor|admin','auth')->name('editpage.do');

});
Route::get('posts',[PostsController::class,'showposts'])->name('showposts');
Route::get('posts/{url}',[PostsController::class,'showpost'])->name('showpost');
Route::post('posts/{url}',[PostsController::class,'delete'])->name('showpost.delete');
Route::get('pages/',[PagesController::class,'showpages'])->name('showpages');
Route::get('pages/{url}',[PagesController::class,'showpage'])->name('showpage');
Route::post('pages/{url}',[PagesController::class,'delete'])->name('showpage.delete');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
