<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[PostController::class,'index'])->name('home');
Route::get('/detail/{slug}/{id}',[PostController::class,'detail']);
Route::post('/save-comment/{slug}/{id}',[PostController::class,'save_comment']);
Route::get('/save-post-form',[PostController::class,'save_post_form']);
Route::post('/save-post-form',[PostController::class,'save_post_data']);
Route::get('/manage-posts',[PostController::class,'manage_posts']);
Route::get('/edit-post-form/{id}',[PostController::class,'edit_post_form']);
Route::get('/delete-post/{id}',[PostController::class,'delete_post']);
Route::get('/moderator-post/{id}',[PostController::class,'moderator_post']);

Auth::routes();
