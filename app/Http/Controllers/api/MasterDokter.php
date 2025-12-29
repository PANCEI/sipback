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
        $dokter=MasterDokterModel::create([
            'kode_dokter'=>$request->kode_dokter,
            'no_sip'=>$request->no_sip,
            'nama_dokter'=>$request->nama_dokter,
            'id_poli'=>$request->id_poli,
            'no_telp'=>$request->no_telp,
            'status_dokter'=>$request->status_dokter,
            'flag_delete'=>0,
            'spesialis'=>$request->spesialis
        ]);
        return response()->json([
            'message'=>'berhasil',
            'data'=>$dokter
        ]);
     }catch(ValidationException $e){
        return response()->json([
            'message'=>'pastikan datanya sesuai'
        ], 422);
     }
    }
    /**
     * get all dokter
     * 
     * 
     */
    public function allDokter(){
      $data = MasterDokterModel::with('poli')->get();

    return response()->json([
        'message' => 'berhasil',
        'data' => $data
    ]);
    }
    /**
     * edit master dokter
     * 
     * 
     */
    public function editDokter(Request $request){
        try{
            $request->validate([
                'id'=>'required',
                'nama_dokter'=>'required',
                'kode_dokter'=>'required'
            ]);
            $dokter=MasterDokterModel::find($request->id);
            if(!$dokter){
                return response()->json([
                    'messaage'=>'pastikan datanya ada'
                ],422);
            }
            $dokter->update([
               'nama_dokter'=>$request->nama_dokter,
               'id_poli'=>$request->id_poli,
               'spesialis'=>$request->spesialis,
               'no_telp'=>$request->no_telp,
               'status_dokter'=>$request->status_dokter 
            ]);
            return response()->json([
                'message'=>'berhasil',
                'data'=>$dokter
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message'=>'\pastikan semua data sesuai'
            ], 422);
        }
    }
    /**
     * ubah status 
     * 
     */
    public function ubahFlag(Request $request){
        try{
            $request->validate([
                'id'=>'required',
                'flag_delete'=>'required'
            ]);
            $dokter = MasterDokterModel::find($request->id);
            if(!$dokter){
                return response()->json([
                    'message'=>'pastikan datanyai',
                    
                ], 422);
            }
            $dokter->update([
                'flag_delete'=>$request->flag_delete
                ]);
            return response()->json([
                'message'=>'berhasil',
                'data'=>$request->all()
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message'=>'pastikan datanya sesuai'
            ]);
        }
    }
    /**
     * get kode dokter
     * 
     */
    public function dokter(Request $request){
        $search = $request->query('search');

    // Jika input kosong, bisa kembalikan array kosong atau beberapa data terbaru
    if (!$search) {
        return response()->json([]);
    }
     $data = MasterDokterModel::select('id', 'kode_dokter', 'nama_dokter')
        ->where('nama_dokter', 'LIKE', "%{$search}%")
        ->orWhere('kode_dokter', 'LIKE', "%{$search}%")
        ->limit(10) // Sangat penting: Batasi jumlah data agar respon cepat
        ->get();

    return response()->json($data);
    }
}
