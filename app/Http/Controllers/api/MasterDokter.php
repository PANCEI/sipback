<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterDokter as MasterDokterModel;
use Illuminate\Validation\ValidationException;
class MasterDokter extends Controller
{
    //
    public function kodeDokter(){
        $kode =[
            'kode_dokter'=> MasterDokterModel::getKodeDokter(),
            'no_sip'=>MasterDokterModel::generateNoSIP()
        ];
        return response()->json([
            'message'=>'berhasil',
            'data'=>$kode
        ]);
    }
}
