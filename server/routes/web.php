<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
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

// Route::get('/register', [UserController::class, 'index']);

// Route::get('/', 'BookController@index');

Route::get('/', [IndexController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    // Route::resource('/book', BookController::class);
    Route::resource('/product', \App\Http\Controllers\ProductController::class);
    Route::resource('/comment', \App\Http\Controllers\CommentController::class);
    Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
    Route::resource('/user', UserController::class);
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'doLogin']);
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store']);
Route::get('/logout', [UserController::class, 'logout']);
