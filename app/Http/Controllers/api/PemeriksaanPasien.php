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
            $request->validate([
                'id_pasien'=>'required|integer',
                'id_dokter'=>'required|integer',
                'sistolik'=>'required|integer',
                'diastolik'=>'required|integer',
                'tanggal'=>'required',
                'keluhan'=>'required'
            ]);
            $pemeriksaanpasien = PemeriksaanPasienModel::create([
              'id_pasien'=>$request->id_pasien,
              'id_dokter'=>$request->id_dokter,
              'sistolik'=>$request->sistolik,
              'diastolik'=>$request->diastolik,
              'keluhan'=>$request->keluhan,
              'tanggal_pemeriksaan'=>$request->tanggal  
            ]);
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
