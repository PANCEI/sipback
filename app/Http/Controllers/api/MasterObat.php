<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterObat as MasterObatModel;

class MasterObat extends Controller
{
    public function all()
    {
        $data = MasterObatModel::all();
        return response()->json([
            "message" => "Berhasil",
            "data" => $data
        ]);
    }

    /**
     * Generate kode obat baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate(Request $request)
    {
        $data = MasterObatModel::generateKodeObat();
        return response()->json([
            "message" => "berhasil",
            "data" => $data
        ]);
    }

    /**
     * Tambahkan data obat baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required'
        ]);

        $obat = MasterObatModel::create([
            'kode_obat' => $request->kode_obat,
            'nama_obat' => $request->nama_obat,
            'flag_delete'=>0
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil',
            'data' => $obat
        ]);
    }
}
