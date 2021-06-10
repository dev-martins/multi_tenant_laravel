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
    Route::group(['middleware' => ['auth:api', 'tenant.filesystem']], function () {
        Route::get('', 'PostController@index')->name('getAllPostsApi');
        Route::get('{id}', 'PostController@getPost')->name('getPostApi');
        Route::put('{id}', 'PostController@updatePost')->name('updatePostApi');
        Route::post('', 'PostController@createPost')->name('createPostApi');
    });
});

Route::prefix('permissions/')->namespace('App\Http\Controllers\ACL')->group(function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'PermissionsController@index')->name('getAllPermissionsApi');
        Route::get('{id}', 'PermissionsController@getPermission')->name('getPermissionApi');
        Route::put('{id}', 'PermissionsController@updatePermission')->name('updatePermissionApi');
        Route::delete('{id}', 'PermissionsController@deletePermission')->name('deletePermissionApi');
        Route::post('', 'PermissionsController@createPermission')->name('createPermissionApi');
    });
});

Route::prefix('roles/')->namespace('App\Http\Controllers\ACL')->group(function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'RolesController@index')->name('getAllRolesApi');
        Route::get('{id}', 'RolesController@getRole')->name('getRoleApi');
        Route::put('{id}', 'RolesController@updateRole')->name('updateRoleApi');
        Route::delete('{id}', 'RolesController@deleteRole')->name('deleteRoleApi');
        Route::post('', 'RolesController@createRole')->name('createRoleApi');
    });
});

Route::prefix('permission_role/')->namespace('App\Http\Controllers\ACL')->group(function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'PermissionsRolesController@index')->name('getAllPermissionsRolesApi');
        Route::get('{id}', 'PermissionsRolesController@getPermissionRole')->name('getPermissionRoleApi');
        Route::put('{id}', 'PermissionsRolesController@updatePermissionRole')->name('updatePermissionRoleApi');
        Route::delete('{id}', 'PermissionsRolesController@deletePermissionRole')->name('deletePermissionRoleApi');
        Route::post('', 'PermissionsRolesController@createPermissionRole')->name('createPermissionRoleApi');
    });
});
