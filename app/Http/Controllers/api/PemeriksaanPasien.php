<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemeriksaanPasien as PemeriksaanPasienModel;
use Illuminate\Validation\ValidationException;
use App\Models\CheckUpObat as CheckUpObatModel;
class PemeriksaanPasien extends Controller
{
    //
    /**
     * tambah data pemeriksaan
     * 
     */
    public function add(Request $request)
    {
        try {
            $request->validate([
                'id_pasien' => 'required|integer',
                'id_dokter' => 'required|integer',
                'sistolik' => 'required|integer',
                'diastolik' => 'required|integer',
                'tanggal' => 'required',
                'keluhan' => 'required'
            ]);
            $pemeriksaanpasien = PemeriksaanPasienModel::create([
                'id_pasien' => $request->id_pasien,
                'id_dokter' => $request->id_dokter,
                'sistolik' => $request->sistolik,
                'diastolik' => $request->diastolik,
                'keluhan' => $request->keluhan,
                'tanggal_pemeriksaan' => $request->tanggal
            ]);
            return response()->json([
                'message' => 'berhasil',
                'data' => $request->all()
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'pastikan datanya sesuai'
            ], 422);
        }
    }
    public function today(Request $request)
    {
        try{
            $request->validate([
                'akses'=>'required'
            ]);
            if($request->akses ===1){
                $pemeriksaanHariIni = PemeriksaanPasienModel::with('pasien')
                    ->whereDate('tanggal_pemeriksaan', now())
                    ->where('diagnosa', null)
                    ->get();
            }else{
                $pemeriksaanHariIni=[];
            }
                return response()->json([
                    'data'=>$pemeriksaanHariIni,
                    "kiriman"=>$request->all()
                ]);

        }catch(ValidationException $e){
            return response()->json([
                'message'=>'pastikan dataya sesuai'
            ]);
        }
    }
    public function pasien(Request $request){
        try{
            $request->validate([
                
            ]);
            return response()->json([
                "data"=>$request->all()
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message'=>'gagal'
            ]);
        }
    }
}
