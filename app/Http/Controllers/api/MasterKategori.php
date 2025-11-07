<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kategoriObat as kategoriObatModel;
use Illuminate\Validation\ValidationException;
class MasterKategori extends Controller
{
    //

    public function all(){
       $kategori = kategoriObatModel::orderBy('id', 'desc')->get();
       return response()->json([
        "message"=>"berhasil",
        "data"=> $kategori
       ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        try{
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);
            
            return response()->json([
                "message" => "berhasil",
            ]);
        }catch(ValidationException $e){
            return response()->json([
                "message"=>"gagal",
                "errors"=>$e->errors()
            ],422);
        }
    }

}
