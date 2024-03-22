<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminProfileController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Registration and login routes
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

// Test route
Route::get('main', [TestController::class, 'main']);


Route::middleware('auth:sanctum')->group(function () {
    // Authentication routes
    Route::post('auth/logout', [AuthController::class, 'logout']);

    // User profile routes
    Route::get('user/{id}/profile', [UserProfileController::class, 'show']);
    Route::put('user/{id}/profile', [UserProfileController::class, 'update']);
    Route::delete('user/{id}/profile', [UserProfileController::class, 'destroy']);
    
    // Skills routes
    Route::get('user/{id}/skills', [UserProfileController::class, 'skills']);

    // Projects routes
    Route::get('user/{id}/projects', [UserProfileController::class, 'projects']);

    // Additional routes for specific roles
    Route::group(['middleware' => 'role:admin'], function () {
        // Route::get('admin', [TestController::class, 'admin']);

        // CRUD operations for users
        Route::get('admin/users', [UserProfileController::class, 'index']);
        Route::post('admin/users', [UserProfileController::class, 'store']);
        Route::get('admin/users/{id}', [UserProfileController::class, 'show']);
        Route::put('admin/users/{id}', [UserProfileController::class, 'update']);
        Route::delete('admin/users/{id}', [UserProfileController::class, 'destroy']);

        Route::get('admin/{id}/profile', [AdminProfileController::class, 'show']);
        Route::put('admin/{id}/profile', [AdminProfileController::class, 'update']);
        Route::delete('admin/{id}/profile', [AdminProfileController::class, 'destroy']);
    });

    Route::group(['middleware' => 'role:supervisor'], function () {
        Route::get('supervisor', [TestController::class, 'supervisor']);

        Route::get('supervisor/users', [UserProfileController::class, 'index']);
    });

    Route::group(['middleware' => 'role:user'], function () {
        Route::get('user', [TestController::class, 'user']);
        Route::get('users/{id}/profile', [UserProfileController::class, 'show']);
        Route::put('users/{id}/profile', [UserProfileController::class, 'update']);
        Route::put('users/{id}/profile', [UserProfileController::class, 'destroy']);
    });
});


// Route::post('auth/register', [AuthController::class, 'register']);
// Route::post('auth/login', [AuthController::class, 'login']);

// Route::get('main', [TestController::class, 'main']);

// Route::group([
//     'middleware' => 'auth:sanctum'
// ], function () {
//     Route::get('auth/logout', [AuthController::class, 'logout']);

//     Route::get('admin', 
//         [TestController::class, 'admin'])->middleware('role:admin');
//     Route::get('supervisor', 
//         [TestController::class, 'supervisor'])->middleware('role:supervisor');
//     Route::get('user', 
//         [TestController::class, 'user'])->middleware('role:user');
// });




