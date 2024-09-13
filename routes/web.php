<?php

use App\Http\Controllers\admin\ManageComments;
use App\Http\Controllers\admin\RegisteruserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
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


})->middleware(['role:admin','auth']);

Route::prefix('dashboard')->group(function (){
    Route::get('/', function () {
                return view('dashboard');
    })->middleware('auth')->name('dashboard');

    Route::controller(PostsController::class)->group(function () {
        Route::get('/newpost','show')->name('newpost.show');
        Route::post('/newpost','store')->name('newpost.store');
        Route::get('/editpost','editpost')->name('editpost');
        Route::post('/editpost','editthepost')->name('editpost.do');
    
    })->middleware('role:admin|editor|writer','auth');

    Route::controller(CategoryController::class)->group(function (){
        Route::get('/managecategories','show')->name('managecats');
        Route::post('/managecategories','show')->name('cataction');
    })->middleware('role:admin|editor','auth');

    Route::controller(PagesController::class)->group(function(){
        Route::get('/newpage','show')->name('newpage');
        Route::post('/newpage','store')->name('newpage.store');
        Route::get('/editpage','editpage')->name('editpage');
        Route::post('/editpage','editthepage')->name('editpage.do');
    })->middleware('role:editor|admin','auth');

    Route::controller(ManageComments::class)->group(function(){
        Route::get('/managecoms','show')->name('managecomments');
        Route::post('/managecoms/{comment}','action')->name('actioncomment');
    })->middleware('role:admin');

    Route::controller(RegisteruserController::class)->group(function(){
        Route::get('/registeruser')->name('registeruser.show');
        Route::post('/registeruser')->name('registeruser.store');
    })->middleware('role:admin');
});

Route::controller(PostsController::class)->group(function(){
    Route::get('posts','showposts')->name('showposts');
    Route::get('posts/{url}','showpost')->name('showpost');
    Route::post('posts/{url}','delete')->name('showpost.delete');
});

Route::controller(PagesController::class)->group(function(){
    Route::get('pages/','showpages')->name('showpages');
    Route::get('pages/{url}','showpage')->name('showpage');
    Route::post('pages/{url}','delete')->name('showpage.delete');
});

Route::post('comments',[CommentsController::class,'store'])->middleware('auth')->name('newcomment');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
