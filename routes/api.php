<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;

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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usersPagination', [UserController::class, 'index']);
    Route::post('/user/create', [UserController::class, 'store']);
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/delete/user/{id}', [UserController::class, 'destroy']);
    Route::get('/getLogInUser', [UserController::class, 'getLogInUser']);

    Route::get('/rolesPagination', [RoleController::class, 'index']);
    Route::get('/roles', [RoleController::class, 'getAll']);
    Route::post('/role/create', [RoleController::class, 'store']);
    Route::put('/role/update/{id}', [RoleController::class, 'update']);
    Route::delete('/delete/role/{id}', [RoleController::class, 'destroy']);

    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::post('assign/permission', [PermissionController::class, 'store']);

    Route::get('/menus', [MenuController::class, 'index']);
    Route::post('/menu/create', [MenuController::class, 'store']);
    Route::put('/menu/sorting', [MenuController::class, 'sorting']);
    Route::patch('/menus/{id}', [MenuController::class, 'updateVisibility']);
    Route::put('/menu/update/{id}', [MenuController::class, 'update']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

