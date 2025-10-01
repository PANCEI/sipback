<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Login;
use App\Http\Controllers\api\Menu;
use App\Http\Controllers\api\Akses;
use App\Http\Controllers\api\MenuAkses;
use App\Http\Controllers\api\SubMenu;

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
    Route::post('/menu/add',[Menu::class , 'insert']);
    Route::post('/menu/bin',[Menu::class , 'delete']);
    Route::put('/menu/change',[Menu::class , 'update']);
    // akses
    Route::get('/akses',[Akses::class , 'akses']);
    Route::get('/akses/{encryptedId}', [Akses::class, 'detailAkses']); 
    Route::post('/akses/add',[Akses::class , 'insert']);
    Route::put("/akses/change", [Akses::class, 'update']);
    Route::delete('/akses/delete', [Akses::class, 'delete']);
    //menu akses
    Route::post('/tambahAkses',[MenuAkses::class, 'tambah']);
    Route::delete('/deleteAkses', [MenuAkses::class , 'HapusAkses']);
    // sub menu 
    Route::get('/submenu',[SubMenu::class,'show']);
    Route::post('/settings', function (Request $request) {
        // Logika untuk mengubah setting user~
        return response()->json(['message' => 'Settings updated.']);
    });
});
//Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/login',[Login::class , 'login']);
