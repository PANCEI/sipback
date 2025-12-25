<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Login;
use App\Http\Controllers\api\Menu;
use App\Http\Controllers\api\Akses;
use App\Http\Controllers\api\MenuAkses;
use App\Http\Controllers\api\SubMenu;
use App\Http\Controllers\api\MasterObat;
use App\Http\Controllers\api\MasterKategori;
use App\Http\Controllers\api\MasterSatuan;
use App\Http\Controllers\api\MasterMitra;
use App\Http\Controllers\api\Medicine_In;
use App\Http\Controllers\api\MasterStorageMedicine;
use App\Http\Controllers\api\MasterPoli;
use App\Http\Controllers\api\MasterDokter;
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
    Route::post('/submenu/add' , [SubMenu::class, "insert"]);
    Route::put('/submenuchange', [SubMenu::class, 'update']);
    Route::delete('/submenudelete',[SubMenu::class, 'delete']);
    // master kategori
    Route::get('/all-katogori-medicine' ,[MasterKategori::class , "all"]);
    Route::post('/add-kategori-medicine' ,[MasterKategori::class , "add"]);
    Route::put('/update-kategori-medicine',[MasterKategori::class, 'update']);
    Route::delete('/delete-kategori-medicine',[MasterKategori::class, 'deleteKategori']);
    // master satuan
    Route::get('/all-satuan-medicine' , [MasterSatuan::class , "all"]);
    Route::post('/add-satuan-medicine' , [MasterSatuan::class , "add"]);
    Route::put('/update-satuan-medicine',[MasterSatuan::class, 'update']);
    Route::delete('/delete-satuan-medicine',[MasterSatuan::class, 'deleteSatuan']);
    // master obat
    Route::get('/all-obat',[MasterObat::class, 'all']);
    Route::get('/generate-code',[MasterObat::class,'generate']);
    Route::post('/add-master-obat', [MasterObat::class, 'add']);
    Route::put('/update-flag-master-obat', [MasterObat::class, 'updateFlag']);
    Route::put('/update-nama-master-obat', [MasterObat::class, 'updatenama']);
    Route::delete('/delete-master-obat', [MasterObat::class, 'delete']);
    Route::get('/kode-obat',[MasterObat::class , 'kodeObat']);
    // Master Mitra
    Route::get('/generate-kodeM', [MasterMitra::class , 'generate']);
    Route::post('/add-mitra', [MasterMitra::class , 'add']);
    Route::get('/all-mitra', [MasterMitra::class , 'all']);
    Route::put('/update-flag-mitra', [MasterMitra::class , 'UpdateFlagdelete']);
    Route::put('/update-master-mitra', [MasterMitra::class , 'UpdateMitra']);
    Route::get('/kode-mitra', [MasterMitra::class , 'kodeMitra']);
    // master medicine in
    Route::get('/all-medicine-in', [Medicine_In::class , 'all']);
    Route::post('/add-medicine-in', [Medicine_In::class , 'add']);
    Route::delete('/delete-medicine-in', [Medicine_In::class , 'delete']);
    // master storage medicine
    Route::get('/all-storage-medicine', [MasterStorageMedicine::class , 'all']);
    // Master Poli
    Route::get('/generate-code-poli',[MasterPoli::class , 'generate']);
    Route::post('/add-master-poli', [MasterPoli::class , 'add']);
    Route::get('/all-master-poli', [MasterPoli::class , 'all']);
    Route::put('/edit-master-poli' , [MasterPoli::class , 'edit']);
    Route::put('ubah-active-poli', [MasterPoli::class, 'ubahStatus']);
    Route::get('/all-data-poli',[MasterPoli::class, 'alldata']);
    // Master Dokter
    Route::get('/generate-kode-dokter', [MasterDokter::class,'kodeDOkter']);
    Route::post('/add-master-dokter',[MasterDokter::class, 'addDokter']);
    Route::get('/get-all-dokter',[MasterDokter::class , 'allDokter']);
    Route::put('edit-master-dokter',[MasterDokter::class, 'editDokter']);
    // Route::post('/submenu/add', 'SubMenu@insert'); cara lama
    Route::post('/settings', function (Request $request) {
        // Logika untuk mengubah setting user~
        return response()->json(['message' => 'Settings updated.']);
    });
});
//Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/login',[Login::class , 'login']);
