<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/articles', [ArticleController::class, 'listArticles']);

Route::get('/articles/{id}', [ArticleController::class, 'readArticle']);

Route::delete('/articles/{id}', [ArticleController::class, 'deleteArticle']);

Route::post('/articles', [ArticleController::class, 'createArticle']);


Route::get('/orders', [OrderController::class, 'listOrders']);

Route::get('/orders/{id}', [OrderController::class, 'readOrder']);

Route::delete('orders/{id}', [OrderController::class, 'deleteOrder']);

Route::post('orders', [OrderController::class, 'createOrder']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Route::post('/me', [AuthController::class, 'me']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');