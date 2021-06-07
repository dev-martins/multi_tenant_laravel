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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('tenants/')->namespace('App\Http\Controllers')->group(function () {
    Route::get('', 'TenantController@getAllTenants')->name('getAllTenantsApi');
    Route::post('', 'TenantController@createTenant')->name('createTenantApi');
    Route::put('{id}', 'TenantController@updateTenant')->name('updateTenantApi');
    Route::delete('{id}', 'TenantController@deleteTenant')->name('deleteTenantApi');
});

Route::prefix('users/')->namespace('App\Http\Controllers')->group(function () {

    Route::prefix('auth/')->group(function () {
        Route::post('login', 'UsersController@loginUser')->name('loginUserApi');
    });

    Route::get('', 'UsersController@getAllUsers')->name('getAllUsersApi');
    Route::post('', 'UsersController@createUser')->name('createUserApi');
    Route::put('{id}', 'UsersController@updateUser')->name('updateUserApi');
    Route::delete('{id}', 'UsersController@deleteUser')->name('deleteUserApi');
});

Route::prefix('posts/')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'PostController@index')->name('getAllPosts');
        Route::post('', 'PostController@createPost')->name('createPostApi');
    });
});
