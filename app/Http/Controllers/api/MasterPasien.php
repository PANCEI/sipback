<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPasien as MasterPasienModel;
use Illuminate\Validation\ValidationException;
class MasterPasien extends Controller
{
    //
    public function norm(){
        $data=MasterPasienModel::generateRm();
        return response()->json([
            'message'=>'berhasil',
            'data'=>$data
        ]);
    }
}
