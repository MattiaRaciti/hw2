<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;

Route::get('/', 'App\Http\Controllers\SignupController@login_form');
Route::post('/', 'App\Http\Controllers\SignupController@do_login');

Route::get('login', 'App\Http\Controllers\SignupController@login_form');
Route::post('login', 'App\Http\Controllers\SignupController@do_login');
Route::get('signup', 'App\Http\Controllers\SignupController@register_form');
Route::post('signup', 'App\Http\Controllers\SignupController@do_register');
Route::get('logout', 'App\Http\Controllers\SignupController@logout');
Route::get('check_username/{search_param}', 'App\Http\Controllers\SignupController@check_username');

Route::get('home', 'App\Http\Controllers\CollectionController@home');
Route::get('favorites/list', 'App\Http\Controllers\CollectionController@list');
Route::get('favorites/add/{name}', 'App\Http\Controllers\CollectionController@add');
Route::get('search_image/{search_param}', 'App\Http\Controllers\CollectionController@search_image');
Route::get('add_favorite/{url}', 'App\Http\Controllers\CollectionController@add_favorite');
Route::get('remove_favorite/{favorite_id}', 'App\Http\Controllers\CollectionController@remove_favorite');
Route::get('preferiti', 'App\Http\Controllers\CollectionController@preferiti');
Route::get('search_user/{search_param}', 'App\Http\Controllers\CollectionController@search_user');
Route::get('view_collection/{search_param}', 'App\Http\Controllers\CollectionController@view_collection');
Route::get('add_like/{search_param}', 'App\Http\Controllers\CollectionController@add_like');
Route::get('get_like_number', 'App\Http\Controllers\CollectionController@get_like_number');
Route::get('undo_like/{search_param}', 'App\Http\Controllers\CollectionController@undo_like');
?>