<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPasien as MasterPasienModel;
use Illuminate\Validation\ValidationException;
use SebastianBergmann\Environment\Console;

class MasterPasien extends Controller
{
    //
    public function norm()
    {
        $data = MasterPasienModel::generateRm();
        return response()->json([
            'message' => 'berhasil',
            'data' => $data
        ]);
    }
    /**
     * menambahkan data baru masster pasien
     * 
     */
    public function add(Request $request)
    {
        try {
            $request->validate([
                'no_rm' => 'required',
                'nama_pasien' => 'required',
                'alamat' => 'required',
                'tgl_lahir' => 'required'
            ]);
            $master = MasterPasienModel::create([
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tgl_lahir,
                'deskripsi' => $request->deskripsi,
                'flag_delete' => 0
            ]);
            return response()->json([
                'message' => 'berhasil',
                'data' => $master
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'gagal'
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


    public function all(Request $request)
    {
        // 1. Ambil parameter dari frontend (dengan nilai default)
        $search = $request->query('search');
        $limit  = $request->query('limit', 5); // Default 10 data per halaman

        // 2. Query dengan kondisi search
        $query = MasterPasienModel::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pasien', 'LIKE', "{$search}%")
                    ->orWhere('no_rm', 'LIKE', "{$search}%");
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
    /**
     * edit data
     * 
     * 
     */
    public function edit(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'nama_pasien' => 'required|string',
                'alamat' => 'required',
                'tgl_lahir' => 'required|date',

            ]);
            $pasien = MasterPasienModel::find($request->id);
            if (!$pasien) {
                return response()->json([
                    'message' => 'data tidak ada'
                ], 422);
            }
            $pasien->update([
                'nama_pasien' => $request->nama_pasien,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tgl_lahir,
                'deskripsi' => $request->deskripsi
            ]);
            return response()->json([
                'message' => 'berhasil',
                'data' => $request->all()
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => "pastikan datanya sesuai"
            ], 422);
        }
    }
    /**
     * 
     * ubah flag delete master pasien
     * 
     */
    public function flag(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'flag_delete' => 'required'
            ]);
            $pasien = MasterPasienModel::find($request->id);
            if (!$pasien) {
                return response()->json([
                    'message' => 'pastikan datanya ada'
                ]);
            }
            $pasien->update([
                'flag_delete' => $request->flag_delete
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
    /**
     * get data pasien
     * 
     * 
     */
    public function pasien(Request $request)
{
    // Ambil keyword dari query string ?search=...
    $search = $request->query('search');

    // Jika input kosong, bisa kembalikan array kosong atau beberapa data terbaru
    if (!$search) {
        return response()->json([]);
    }

    $data = MasterPasienModel::select('no_rm', 'nama_pasien')
        ->where('nama_pasien', 'LIKE', "%{$search}%")
        ->orWhere('no_rm', 'LIKE', "%{$search}%")
        ->limit(10) // Sangat penting: Batasi jumlah data agar respon cepat
        ->get();

    return response()->json($data);
}
}
