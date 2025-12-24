<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPoli as MasterPoliModel;
use Illuminate\Validation\ValidationException;
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
    /**
     * tambah master poli untuk menambahkan data poli baru
     * 
     */
    public function add(Request $request){
        try{
            $request->validate([
                'kode_poli' => 'required',
                'nama_poli' => 'required',
                
            ]);
            $poli = MasterPoliModel::create([
                'kode_poli' => $request->kode_poli,
                'nama_poli' => $request->nama_poli,
                'deskripsi' => $request->deskripsi,
                'is_active'=>0
            ]);
            return response()->json([
                'message' => 'Berhasil menambahkan data poli',
                'data' => $poli
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'pastikan data terisi dengan benar',
                'errors' => $e->errors()
            ], 422);
        }
    }
    /**
     * menampilkan semua data master poli
     * 
     */
    public function all(){
        $data = MasterPoliModel::all();
        return response()->json([
            'message' => 'Berhasil mengambil data poli',
            'data' => $data
        ]);
    }
    /**
     * edit master poli
     * 
     * 
     */
    public function edit(Request $request){
        try{
            $request->validate([
                'id'=>'required',
                'kode_poli'=>'required',
                'nama_poli'=>'required'
            ]);
            $poli= MasterPoliModel::find($request->id);
            if(!$poli){
                return response()->json([
                    'message'=>'gagal',
                    'data'=>'data tidak di temukan'
                ], 404);
            }
            $poli->update([
                'kode_poli'=>$request->kode_poli,
                'nama_poli'=>$request->nama_poli, 
                'deskripsi'=>$request->deskripsi
            ]);
            return response()->json([
                'message'=>'data berhasil di ubah',
                'data'=>$request->all()
            ]);
        }catch(ValidationException $e){
              return response()->json([
                'message' => 'pastikan data terisi dengan benar',
                'errors' => $e->errors()
            ], 422);
        }
    }
    /**
     * ubah status active poli
     * 
     * 
     */
    public function ubahStatus(Request $request){
        try{
            $request->validate([
                'id'=>'required',
                'is_active'=>'required',
            ]);
            $poli=MasterPoliModel::find($request->id);
            if(!$poli){
                return response()->json([
                    'message'=>'gagal',
                    'data'=>'pastikan datanya sesuai'
                ]);
            }
            $poli->update([
                'is_active'=>$request->is_active
            ]);
            return response()->json([
                'message'=>'berhasil',
                'data'=>$request->all()
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message'=>'papstikan data terisi dengan benar',
                'errors'=>$e->errors()
            ]);
        }
    }
    /***
     * 
     * mendapatkan kode poli
     * 
     */
    public function alldata(){
        $poli=MasterPoliModel::select('id', 'kode_poli', 'nama_poli')->where('is_active', 0)->get();
        return response()->json([
            'message'=>'berhasil',
            'data'=>$poli
        ]);
    }
}
