<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine_In as MedicineInModel;
use Illuminate\Validation\ValidationException;
use App\Models\MasterStorageMedicine as MasterStorageMedicineModel;
use Illuminate\Support\Facades\DB;
class Medicine_In extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function all(Request $request ) {
   try {
     
        $perPage = $request->query('per_page', 10); 
        $search = $request->query('search');

      
        $query = DB::table('log_medicine_in as lmi')
            ->select(
                'lmi.id',
                'lmi.kode_obat',
                'mo.nama_obat',
                'mm.nama_mitra',
                'lmi.jumlah_masuk',
                'lmi.tanggal_kadaluarsa',
                'users.name as petugas', 
                'lmi.keterangan',
                'lmi.tanggal_masuk' 
            )
            ->join('master_obat as mo', 'mo.kode_obat', '=', 'lmi.kode_obat')
            ->join('master_mitra as mm', 'mm.kode_mitra', '=', 'lmi.kode_mitra')
            ->leftJoin('users', 'users.email', '=', 'lmi.created_by')
            ->where('mo.flag_delete', 0)
            ->where('mm.flag_delete', 0);

        // 3. Tambahkan Fitur Pencarian (Opsional tapi sangat disarankan)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('mo.nama_obat', 'like', "%{$search}%")
                  ->orWhere('lmi.kode_obat', 'like', "%{$search}%")
                  ->orWhere('mm.nama_mitra', 'like', "%{$search}%");
            });
        }

        // 4. Gunakan paginate(), bukan get()
        $data = $query->orderBy('lmi.id', 'desc')->paginate($perPage);

        return response()->json([
            "status" => 200,
            "message" => "berhasil",
            "data" => $data // Laravel otomatis menyertakan meta-data pagination
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            "status" => 500,
            "message" => "Gagal mengambil data",
            "error" => $e->getMessage()
        ], 500);
    }
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
/**
 * untuk menghapus data medicine in
 * mengurangi stok di master storage medicine
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
public function delete(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $medicineIn = MedicineInModel::find($request->id);

        if (!$medicineIn) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $storage = MasterStorageMedicineModel::where('kode_obat', $medicineIn->kode_obat)->first();

        if ($storage) {
            $storage->quantity -= $medicineIn->jumlah_masuk;
            if ($storage->quantity < 0) {
                 return response()->json([
           'message' => 'Tidak dapat menghapus data karena stok obat tidak mencukupi',
    ], 422);
            }
            $storage->save();
        }

        $medicineIn->delete();

        return response()->json([
            'message' => 'berhasil menghapus data',
        ]);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Pastikan field terisi dengan benar',
        ], 422);
    }
}

}
