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
    /**
     * menambahkan data baru masster pasien
     * 
     */
    public function add(Request $request){
        try{
            $request->validate([
                'no_rm'=>'required',
                'nama_pasien'=>'required',
                'alamat'=>'required',
                'tgl_lahir'=>'required'
            ]);
        $master= MasterPasienModel::create([
            'no_rm'=>$request->no_rm,
            'nama_pasien'=>$request->nama_pasien,
            'alamat'=>$request->alamat,
            'tanggal_lahir'=>$request->tgl_lahir,
            'deskripsi'=>$request->deskripsi,
            'flag_delete'=>0
        ]);
            return response()->json([
                'message'=>'berhasil',
                'data'=>$master
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message'=>'gagal'
            ], 422);
        }
    }
    /***
     * 
     * get All data Master Pasien
     * 
     */
    // public function all(){
    //     $data=MasterPasienModel::all();
    //     return response()->json([
    //         'message'=>'berhasil',
    //         'data'=>$data
    //     ]);
    // }
 

public function all(Request $request) {
    // 1. Ambil parameter dari frontend (dengan nilai default)
    $search = $request->query('search');
    $limit  = $request->query('limit', 5); // Default 10 data per halaman

    // 2. Query dengan kondisi search
    $query = MasterPasienModel::query();

    if (!empty($search)) {
        $query->where(function($q) use ($search) {
            $q->where('nama_pasien', 'LIKE', "%{$search}%")
              ->orWhere('no_rm', 'LIKE', "%{$search}%");
        });
    }

    // 3. Gunakan paginate() bukan all()
    // paginate() otomatis menangani offset/limit dan menghitung total data
    $data = $query->latest()->paginate($limit);

    return response()->json([
        'message' => 'berhasil',
        'data'    => $data->items(),      // Hanya data untuk halaman ini
        'total'   => $data->total(),      // Total keseluruhan data di database
        'current_page' => $data->currentPage(),
        'last_page'    => $data->lastPage(),
    ]);
}
}
