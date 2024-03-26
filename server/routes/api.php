<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

# 需要登录
Route::group(["middleware" => 'auth:sanctum'], function () {
    Route::get('/logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);

    // 个人评论列表
    Route::get('/user/comment', [\App\Http\Controllers\Api\CommentController::class, 'userList']);

    // 提交评分
    Route::post('/score', [\App\Http\Controllers\Api\ScoreController::class, 'store']);

    // 提交评论
    Route::post('/comment', [\App\Http\Controllers\Api\CommentController::class, 'store']);
    // 删除评论
    Route::delete('/comment/{id}', [\App\Http\Controllers\Api\CommentController::class, 'destroy']);
});

# 无需登录
Route::group([], function () {
    Route::post('/register', [\App\Http\Controllers\Api\UserController::class, 'store']);
    Route::post('/login', [\App\Http\Controllers\Api\UserController::class, 'doLogin']);

    // 获取评论列表 - 分页
    Route::get('/comment', [\App\Http\Controllers\Api\CommentController::class, 'index']);
    // 获取材料列表 - 分页
    Route::get('/product', [\App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('/product_list', [\App\Http\Controllers\Api\ProductController::class, 'list']);

    // Route::get('product/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
    Route::get('product/search', [\App\Http\Controllers\Api\ProductController::class, 'search']);
});

