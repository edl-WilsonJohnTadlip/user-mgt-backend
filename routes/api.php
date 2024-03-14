<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;

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

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::get('main', [TestController::class, 'main']);

Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('auth/logout', [AuthController::class, 'logout']);

    Route::get('admin', 
        [TestController::class, 'admin'])->middleware('role:admin');
    Route::get('supervisor', 
        [TestController::class, 'supervisor'])->middleware('role:supervisor');
    Route::get('user', 
        [TestController::class, 'user'])->middleware('role:user');
});
