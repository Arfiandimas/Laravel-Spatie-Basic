<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controller
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionViaRoleContoller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GivePermissionUser;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->middleware(['auth:admin', 'scope:admin', 'role:super-admin']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth:admin', 'scope:admin', 'role:super-admin']], function () {
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/store', [RoleController::class, 'store']);

        Route::group(['prefix' => 'role={role_id}/permission'], function () {
            Route::get('/', [PermissionViaRoleContoller::class, 'index']);
            Route::post('/store', [PermissionViaRoleContoller::class, 'store']);
        });
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index']);
        Route::post('/store', [PermissionController::class, 'store']);

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [GivePermissionUser::class, 'index']);
            Route::post('/id={id}/store', [GivePermissionUser::class, 'store']);
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/store', [UserController::class, 'store']);
    });
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/', [CustomerController::class, 'index']);
    Route::post('/store', [CustomerController::class, 'store']);
});

// Product For Admin
Route::group(['prefix' => 'product', 'middleware' => ['auth:admin','role:super-admin|employee|customer']], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::get('/id={id}/show', [ProductController::class, 'show']);
});