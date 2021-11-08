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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//  auth api's
Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'auth'
], function ()
{
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

// page api's
Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'page'
], function(){
    Route::post('create', 'PageController@create');
    Route::post('{id}/attach-post', 'PageController@attachPost');
});

// follow api's
Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'follow'
], function(){
    Route::put('page/{id}', 'PageController@followPage');
    Route::put('person/{id}', 'PersonController@followPerson');
});

// person api's
Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'person'
], function(){
    Route::post('attach-post', 'PersonController@attachPost');
});
