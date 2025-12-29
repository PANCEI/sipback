<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemeriksaanPasien as PemeriksaanPasienModel;
use Illuminate\Validation\ValidationException;
class PemeriksaanPasien extends Controller
{
    //
    /**
     * tambah data pemeriksaan
     * 
     */
    public function add(Request $request){
        try{
            return response()->json([
                'message'=>'berhasil',
                'data'=>$request->all()
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message'=>'pastikan datanya sesuai'
            ],422);
        }
    }
}
