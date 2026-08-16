<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CollectionController;


Route::get('/', [SignupController::class, 'login_form']);
Route::post('/', [SignupController::class, 'do_login']);

Route::get('login', [SignupController::class, 'login_form']);
Route::post('login', [SignupController::class, 'do_login']);
Route::get('signup', [SignupController::class, 'register_form']);
Route::post('signup', [SignupController::class, 'do_register']);
Route::get('logout', [SignupController::class, 'logout']);
Route::get('check_username/{search_param}', [SignupController::class, 'check_username']);

Route::get('home', [CollectionController::class, 'home']);
Route::get('favorites/list', [CollectionController::class, 'list']);
Route::post('add_favorite', [CollectionController::class, 'add_favorite']);
Route::get('search_image/{search_param}', [CollectionController::class, 'search_image']);
Route::get('remove_favorite/{favorite_id}', [CollectionController::class, 'remove_favorite']);
Route::get('preferiti', [CollectionController::class, 'preferiti']);
Route::get('search_user/{search_param}', [CollectionController::class, 'search_user']);
Route::get('view_collection/{search_param}', [CollectionController::class, 'view_collection']);
Route::get('add_like/{search_param}', [CollectionController::class, 'add_like']);
Route::get('get_like_number', [CollectionController::class, 'get_like_number']);
Route::get('undo_like/{search_param}', [CollectionController::class, 'undo_like']);