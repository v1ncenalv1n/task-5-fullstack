<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthPassportController;
use App\Http\Controllers\Api\v1\PostController;

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

Route::prefix('v1/')->group(function() {
    Route::post('register', [AuthPassportController::class, 'register']);
    Route::post('login', [AuthPassportController::class, 'login']);

    Route::middleware('auth:api')->group(function(){
        Route::get('user/getuser', [AuthPassportController::class, 'user']);
        Route::get('logout', [AuthPassportController::class, 'logout']);
        Route::resource('posts', PostController::class);
    });
});


