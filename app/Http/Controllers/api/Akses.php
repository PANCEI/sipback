<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akses As AksesModel;
use App\Helpers\CryptoHelper;
use App\Models\MenuAkses as MenuAksesModel;
use App\Models\Menu as MenuModel;
class Akses extends Controller
{
    public function akses(Request $request)
    {
        $data = AksesModel::all();
      return response()->json([
          "status" => "berhasil",
          "data" => $data
      ]);
    }
    public function detailAkses($encryptedId){
        $id = CryptoHelper::decryptData($encryptedId);
        $menuAkses= MenuAksesModel::where('id_akses', $id)->get();
        $menu= MenuModel::all();
        return response()->json([
            "status" => "berhasil",
            "menuakses"=>$menuAkses,
            'menu'=>$menu, 
            "id"=>$id   
        ]);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'akses' => 'required'
        ]);
    $akses = New AksesModel();
    $akses->akses=trim(htmlspecialchars(htmlentities(CryptoHelper::decryptData($request->akses))));
    $akses->save();
     return response()->json([
        "status" => "berhasil",
        "message" => "Menu berhasil ditambahkan.",
        "data" => $akses
        ]);
    }
    public function update(Request  $request){
        $akses = AksesModel::find(CryptoHelper::decryptData($request->id));
        if(!$akses){
            return response()->json([
                "status"=>"gagal",
                "message"=>"Akses Tidak di Temukan"
            ], 404);
        }
        $update=[
            "akses"=>trim(htmlspecialchars(htmlentities(CryptoHelper::decryptData($request->akses))))
        ];
        $akses->update($update);
        return response()->json([
        "status" => "berhasil",
        "message" => "Menu berhasil diperbarui.",
        "data" => $akses
    ]);
    }
    public function delete(Request $request){
        $cari = AksesModel::find(CryptoHelper::decryptData($request->id));
        if(!$cari){
            return response()->json([
                "status"=>"Gagal",
                "message"=>"Akses Tidak ada"
            ], 404);
        }
        $cari->delete();
       return response()->json([
        "status" => "berhasil",
        "message" => "Berhasil Di Hapus."
    ]);
    }
}
