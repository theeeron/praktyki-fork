<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

