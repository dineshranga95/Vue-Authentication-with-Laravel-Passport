<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::prefix('auth')->group(function(){
    Route::post('/register', 'Api\AuthController@register');
    Route::post('/login', 'Api\AuthController@login');

    Route::get('/login', function(){
        return response()->json(['msg'=>'unauthorized'], 401);
    } )->name('login');

    Route::middleware('auth:api')->group(function(){
        Route::post('/logout', 'Api\AuthController@logout');
        Route::get('/user', 'Api\AuthController@index');
        Route::get('/user/{id}', 'Api\AuthController@show');

        Route::resource('/blog', 'Api\BlogController');
    });
    
});
