<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kategoriObat as kategoriObatModel;
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
        return response()->json([
            "message" => "berhasil",
        ]);
    }

}
