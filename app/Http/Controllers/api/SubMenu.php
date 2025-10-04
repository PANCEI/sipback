<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu as SubMenuModel;

class SubMenu extends Controller
{
    
    public function show(){
        $data= SubMenuModel::getWithMenu();
    return response()->json([
        'status'=>'Berhasil',
        'message'=>'Data Berhasil Di Temukan',
        "data"=>$data
    ]);
    }
    public function insert(Request $request){
        // validasi
        $request->validate([
            "icon"=>"required",
            "id_menu"=>"required",
            "nama_sub_menu"=>"required",
            "path"=>"required",
            "url"=>"required"
        ]);
        // $data = $request->all();
        // if($request->sub !== "YA") {
        //     $data['sub'] = null;
        // }else{
        //     $data['sub'] = 1;
        // }
         $data = $request->all();
        $data['sub'] = $request->sub === "Ya" ? 1 : null;
        SubMenuModel::create($data);
         return response()->json([
        'status'=>'Berhasil',
        'message'=>'Data Berhasil Di Tambahkan'
    ]);
    }
    public function delete(Request $request){
        $subMenu = SubMenuModel::find($request->id);
        if(!$subMenu){
            return response()->json([
                "status"=>"gagal",
                "message"=>"Data Tidak Di Temukan"
            ], 404);
        
   }
    $subMenu->delete();
      return response()->json([
                "status"=>"Berhasil",
                "message"=>"Data Berhasil Di Hapus"
            ]);
    }
    public function update(Request $request){
    $request->validate([
        'id'=>'required',
        'icon'=>'required',
        'id_menu'=>'required',
        'nama_sub_menu'=>'required',
        'path'=>'required',
        'url'=>'required'
    ]);
    $subMenu = SubMenuModel::find($request->id);
    if(!$subMenu){
        return response()->json([
            'status'=>'Gagal',
            'message'=>'Gagal Melakukan Update'
        ], 404);
    }
    $data= $request->all();
    $data['sub'] = $request->sub === "Ya" ? 1 : null;
    $subMenu->update($data);
    return response()->json([
        'status'=>'Berhasil',
        'message'=>'Data Berhasil Di Update',
        'data'=>$subMenu
    ]);
    }
}