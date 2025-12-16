<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterMitra as MasterMitraModel;
use Illuminate\Validation\ValidationException;
class MasterMitra extends Controller
{
    
    /**
     * Generate kode Mitra Baru
     * @param JSONRESPONSE
     * 
     */
    public function generate(){
        $kode_mitra = MasterMitraModel::generateKodeMitra();
        return response()->json([
            'message'=>'berhasil',
            'data'=>$kode_mitra
        ]);
    }
    /**
     * Tambah Mitra Baru
     * @param Request
     * @param JSONRESPONSE
     * 
     */
    public function add(Request $request){
        try{
            $request->validate([
                'kode_mitra'=>'required',
                'nama_mitra'=>'required|string',
                'alamat'=>'required|string',
                'no_telepon'=>'required|string',
            ]);
          $mitra =   MasterMitraModel::create([
                'kode_mitra'=>$request->kode_mitra,
                'nama_mitra'=>$request->nama_mitra,
                'alamat'=>$request->alamat,
                'no_telepon'=>$request->no_telepon,
                'flag_delete'=>0
            ]);
            return response()->json([
                'message'=>'berhasil tambah mitra',
                'data'=>$mitra
            ]);
        }catch(ValidationException $e){
             return response()->json([
                "message"=>"Pastikapn field terisi dengan benar",
            ],422);
        }
    }
    /**
     * menampilkan semua mitra
     * @param JSONRESPONSE
     */
    public function all(){
       $mitra = MasterMitraModel::orderBy('kode_mitra', 'desc')->get();
        return response()->json([
            'message'=>'berhasil',
            'data'=>$mitra
        ]);
    }
    /**
     * fungsi untuk melakukan flag delete
     * 
     * 
     * 
     */
  public function UpdateFlagdelete(Request $request)
{
    try {
        $request->validate([
            'kode_mitra'  => 'required|string',
            'flag_delete' => 'required|integer'
        ]);

        $mitra = MasterMitraModel::where('kode_mitra', $request->kode_mitra)->first();

        if (!$mitra) {
            return response()->json([
                'message' => 'mitra tidak ditemukan'
            ], 404);
        }

        $mitra->update([
            'flag_delete' => $request->flag_delete
        ]);

        return response()->json([
            'message' => 'berhasil update flag delete',
            'data'    => $mitra
        ]);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Pastikan field terisi dengan benar'
        ], 422);
    }
}
/**
     * fungsi untuk melakuakan edit untuk master mitra
     * 
     * 
     * 
     */
    public function UpdateMitra(Request $request){
        try{
            $request->validate([
                'kode_mitra'=>'required|string',
                'nama_mitra'=>'required|string',
                'alamat'=>'required|string',
                'no_telepon'=>'required|string',
            ]);
          $mitra = MasterMitraModel::where('kode_mitra', $request->kode_mitra)->first();
          if(!$mitra){
            return response()->json([
                'message'=>'mitra tidak ditemukan'
            ],404);
          }
          $mitra->update([
                'nama_mitra'=>$request->nama_mitra,
                'alamat'=>$request->alamat,
                'no_telepon'=>$request->no_telepon,
            ]);
            return response()->json([
                'message'=>'berhasil update mitra',
                'data'=>$mitra
            ]);
        }catch(ValidationException $e){
             return response()->json([
                "message"=>"Pastikapn field terisi dengan benar",
            ],422);
        }
    }

}
