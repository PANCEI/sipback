<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPoli as MasterPoliModel;
class MasterPoli extends Controller
{
    //
    /**
     * generate kode poli untuk dapat melakukan generate kode poli
     * 
     */
    public function generate(){
        $kodePoli = MasterPoliModel::generateKodePoli();
        return response()->json([
            'data' => $kodePoli
        ]);   
    }
}
