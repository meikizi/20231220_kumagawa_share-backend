<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', [LoginController::class, 'login'])->middleware('guest');

Route::get('/{user_uid?}', [PostController::class, 'index']);
Route::get('/posts/{user_uid}/{post_id}', [PostController::class, 'getPost']);
Route::post('/', [PostController::class, 'store']);
Route::delete('/{post_id}', [PostController::class, 'delete']);
Route::post('/like/{user_uid}/{post_id}', [LikeController::class, 'like']);
Route::delete('/unlike/{user_uid}/{post_id}', [LikeController::class, 'deleteLike']);
Route::get('/comments/{post_id}', [CommentController::class, 'getComment']);
Route::post('/comments/', [CommentController::class, 'comment']);
