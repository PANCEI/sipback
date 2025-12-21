<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine_In as MedicineInModel;
use Illuminate\Validation\ValidationException;
use App\Models\MasterStorageMedicine as MasterStorageMedicineModel;
class Medicine_In extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(){

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function add(Request $request)
{
    try {
        $request->validate([
            'kode_obat' => 'required|string',
            'kode_mitra' => 'required|string',
            'jumlah_masuk' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'tanggal_kadaluarsa' => 'required|date',
            'penerima' => 'required'
        ]);

        $medicineIn = MedicineInModel::create([
            'kode_obat' => $request->kode_obat,
            'kode_mitra' => $request->kode_mitra,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'keterangan' => $request->keterangan,
            'created_by' => $request->penerima,
        ]);

        if ($medicineIn) {
            $storage = MasterStorageMedicineModel::where('kode_obat', $request->kode_obat)->first();

            if ($storage) {
                $storage->quantity += $request->jumlah_masuk;
                $storage->save();
            } else {
                MasterStorageMedicineModel::create([
                    'kode_obat' => $request->kode_obat,
                    'quantity' => $request->jumlah_masuk
                ]);
            }
        }

        return response()->json([
            'message' => 'berhasil',
            'data' => $request->all()
        ]);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Pastikan field terisi dengan benar',
        ], 422);
    }
}

}
