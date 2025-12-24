<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterDokter as MasterDokterModel;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\error;

class MasterDokter extends Controller
{
    //
    /**
     * 
     * MENDAPATKAN KODE DOKTER
     * 
     * 
     */
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
    /**
     * menambah data master dokter
     * 
     */
    public function addDokter(Request $request){
     try{
        $request->validate([
            'kode_dokter'=>'required',
            'no_sip'=>'required',
            'nama_dokter'=>'required',
            'id_poli'=>'required',
            'no_telp'=>'required',
            'status_dokter'=>'required'
        ]);
        
        return response()->json([
            'message'=>'berhasil',
            'data'=>$request->all()
        ]);
     }catch(ValidationException $e){
        return response()->json([
            'message'=>'pastikan datanya sesuai'
        ], 422);
     }
    }
}
