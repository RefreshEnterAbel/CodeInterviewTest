<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//register user api router link
Route::post('/auth/register', [RegisterController::class, 'register']);
//login user api router link
Route::post('/auth/login', [LoginController::class, 'login']);

// middleware on auth:sanctum (after login)
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me',  [AuthController::class, 'user']);
    Route::post('/auth/logout', [LoginController::class, 'logout']);
});
