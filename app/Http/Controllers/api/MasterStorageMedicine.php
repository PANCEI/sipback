<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterObat as MasterObatModel;
class MasterStorageMedicine extends Controller
{
    //
    public function all (){
      $data = MasterObatModel::with(['kategori', 'satuan', 'storage'])->get();
        return response()->json([
            "message" => "Berhasil",
            "data" => $data
        ]);
    }
}
