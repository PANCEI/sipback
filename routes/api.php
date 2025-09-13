<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Login;
use App\Http\Controllers\api\Menu;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/menu',[Menu::class , 'index']);
    Route::get('/menu/all',[Menu::class , 'all']);

    Route::post('/settings', function (Request $request) {
        // Logika untuk mengubah setting user
        return response()->json(['message' => 'Settings updated.']);
    });
});
//Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/login',[Login::class , 'login']);
