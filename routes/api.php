<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

// Route::get('/welcom', function (){ return "welcome ";});


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/post', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update'])->can("update", "post");
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->can("delete", 'post');

    
    Route::post('/posts/{post}/comment', [CommentController::class, 'store']);

    

    Route::middleware('admin')->group(function () {
        Route::post('/user', [UserController::class, 'store'])->middleware("admin");
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->can("delete" , "user");
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::post('/login', [AuthController::class, 'login']);