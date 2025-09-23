<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuAkses as MenuAksesModel;
use App\Helpers\CryptoHelper;
class MenuAkses extends Controller
{
    public function Tambah(Request $request ){
        $request->validate([
            'id_menu'=>"required",
            "id_akses"=>"required"
        ]);
        $menuAkses= new MenuAksesModel();
        $menuAkses->id_menu= trim(htmlspecialchars(htmlentities(CryptoHelper::decryptData($request->id_menu))));
        $menuAkses->id_akses= trim(htmlspecialchars(htmlentities(CryptoHelper::decryptData($request->id_akses))));
        $menuAkses->save();
        return response()->json([
            "status"=>"berhasil",
           "message"=>"Akses Berhasil Di Tambahkan",
           "data"=>$menuAkses
        ]);

    }
    public function HapusAkses(Request $request){
        
        $akses = MenuAksesModel::where([
            'id_akses'=>CryptoHelper::decryptData($request->id_akses),
            'id_menu'=>CryptoHelper::decryptData($request->id_menu)
        ])->first();
        $akses->delete();
        return response()->json([
            'status'=>"Data Berhasil",
            "data"=>$akses
        ]);  
    }
}
