<?php

use App\Http\Controllers\Api\UserApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users/{id?}', [UserApiController::class, 'showUser']);
Route::post('/add/users', [UserApiController::class, 'addUser']);
Route::post('/add/multi/users', [UserApiController::class, 'addMultiUser']);
Route::put('/update/users/{id}', [UserApiController::class, 'updateUser']);
