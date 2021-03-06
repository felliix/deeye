<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\v1\Auth\UserController;
use App\Http\Controllers\Api\v1\FollowController;
use App\Http\Controllers\Api\v1\AlertController;
use App\Http\Controllers\Api\v1\SupportController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function () {
  Route::post('/checkUser', [UserController::class , 'checkUser']);
  Route::post('/login', [UserController::class , 'login'])->name('login');
  Route::post('/signup', [UserController::class , 'signup']);
});

Route::get('/posts/unsigned', 'App\Http\Controllers\Api\v1\PostController@index');

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/alerts', 'App\Http\Controllers\Api\v1\AlertController@index');
  Route::get('/posts', 'App\Http\Controllers\Api\v1\PostController@index');
  Route::get('/posts/{id}', 'App\Http\Controllers\Api\v1\PostController@show');
  Route::put('/posts/{id}', 'App\Http\Controllers\Api\v1\PostController@update');
  Route::put('/posts/{id}/report', 'App\Http\Controllers\Api\v1\PostController@report');
  Route::put('/posts/{id}/save', 'App\Http\Controllers\Api\v1\PostController@save');
  Route::post('/posts/{id}/share', 'App\Http\Controllers\Api\v1\PostController@share');
  Route::put('/posts/{id}/like', 'App\Http\Controllers\Api\v1\PostController@like');
  Route::put('/posts/{id}/hide', 'App\Http\Controllers\Api\v1\PostController@hide');
  Route::delete('/posts/{id}', 'App\Http\Controllers\Api\v1\PostController@delete');
  Route::post('/posts/{id?}', 'App\Http\Controllers\Api\v1\PostController@store');
  Route::post('/posts/{id}/share', 'App\Http\Controllers\Api\v1\PostController@share');
  Route::post('/posts/{id}/reason', 'App\Http\Controllers\Api\v1\PostController@reason');
  
  Route::post('/attachments', 'App\Http\Controllers\Api\v1\AttachmentController@store');
  Route::delete('/attachments/{id}', 'App\Http\Controllers\Api\v1\AttachmentController@delete');
  
  Route::get('/posts/{postId}/comments', 'App\Http\Controllers\Api\v1\PostCommentController@index');
  Route::post('/posts/{postId}/comments', 'App\Http\Controllers\Api\v1\PostCommentController@store');
  
  Route::get('/comments/{commentId}/comments', 'App\Http\Controllers\Api\v1\CommentController@index');
  Route::post('/comments/{commentId}/comments', 'App\Http\Controllers\Api\v1\CommentController@store');
  Route::put('/comments/{commentId}/like', 'App\Http\Controllers\Api\v1\CommentController@like');
  
  Route::get('/profiles/{profileId}/posts', 'App\Http\Controllers\Api\v1\ProfileController@posts');
  Route::post('/profiles/{profileId}', 'App\Http\Controllers\Api\v1\ProfileController@store');
  Route::get('/profiles/{profileId}', 'App\Http\Controllers\Api\v1\ProfileController@show');
  Route::put('/profiles', 'App\Http\Controllers\Api\v1\ProfileController@update');
  Route::post('/support/{profileId}', 'App\Http\Controllers\Api\v1\SupportController@store');

  Route::put('/users', 'App\Http\Controllers\Api\v1\Auth\UserController@location');
  
  Route::get('/followers', 'App\Http\Controllers\Api\v1\FollowController@index');
  Route::post('/follow', 'App\Http\Controllers\Api\v1\FollowController@follow');
});

Route::get('/missing/{userId}', 'App\Http\Controllers\Api\v1\PostController@missing');
