<?php

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

Route::group(['prefix' => 'books', 'namespace' => 'Book'], function(){
    Route::get('/', 'IndexController');
    Route::post('/', 'StoreController');
    Route::get('/{book}', 'ShowController');
    Route::patch('/{book}', 'UpdateController');
    Route::delete('/{book}', 'DeleteController');
});
Route::group(['prefix' => 'users', 'namespace' => 'User'], function(){
    Route::get('/', 'IndexController');
    Route::post('/', 'StoreController');
    Route::get('/{user}', 'ShowController');
    Route::patch('/{user}', 'UpdateController');
    Route::delete('/{user}', 'DeleteController');
});
Route::group(['prefix' => 'loans', 'namespace' => 'Loan'], function(){
    Route::get('/', 'IndexController');
    Route::post('/', 'StoreController');
    Route::get('/{loan}', 'ShowController');
    Route::patch('/{loan}', 'UpdateController');
    Route::delete('/{loan}', 'DeleteController');
});
