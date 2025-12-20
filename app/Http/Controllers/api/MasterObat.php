<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterObat as MasterObatModel;
use App\Models\ObatKatergoriRelasi as ObatKategoriRelasiModel;
use Illuminate\Validation\ValidationException;
class MasterObat extends Controller
{
    public function all()
    {
        $data = MasterObatModel::with(['kategori', 'satuan'])->get();
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
            'nama_obat' => 'required',
            'id_satuan' => 'required',
            'kandungan' => 'required',
            
        ]);

        $obat = MasterObatModel::create([
            'kode_obat' => $request->kode_obat,
            'nama_obat' => $request->nama_obat,
            'id_satuan' => $request->id_satuan,
            'kandungan' => $request->kandungan,
            'flag_delete'=>0
        ]);
        $kategori = $request->id_kategori; // Mengambil array kategori dari request
        foreach ($kategori as $kat) {
            ObatKategoriRelasiModel::create([
                'kode_obat' => $request->kode_obat,
                'kategori_id' => $kat,
            ]);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'berhasil',
            'data' => $obat
        ]);
    }
    /**
     * melakukan update flag_delete terhadap kode obat
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateflag(Request $request){
        // $request->validate([
        //     'kode_obat' => 'required',
        //     'flag_delete' => 'required'
        // ]);
        $masterobat = MasterObatModel::find($request->kode_obat);
        if(!$masterobat){
            return response()->json([
                'message'=>'gagal',
                'data'=>'data tidak ditemukan'
            ]);
        }
        $flag =$request->flag_delete;
        $masterobat->update(['flag_delete'=>$flag]);
        return response()->json([
            'message'=>'berhasil',
            "data"=>"Status Berhasil Di Ubah"
        ]);
    }
    /**
     * melakukan update nama obat terhadap kode obat
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function updatenama(Request $request){
        $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',
            'id_satuan'=>'required'
        ]);
        $masterobat = MasterObatModel::find($request->kode_obat);
        if(!$masterobat){
            return response()->json([
                'message'=>'gagal',
                'data'=>'data tidak ditemukan'
            ]);
        }
        $nama =$request->nama_obat;
        $masterobat->update([
            'nama_obat'=>$nama,
            'kandungan'=>$request->kandungan,
            'id_satuan'=>$request->id_satuan
         ]);
           $masterobat->kategori()->sync($request->id_kategori);
        return response()->json([
            'message'=>'berhasil',
            "data"=>"Nama Obat Berhasil Di Ubah"
        ]);
    }

    /**
     * melakukan delete terhadap kode obat
     * fitur ini di non aktifkan sementara menunggu konfirmasi lanjutan
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        $request->validate([
            'kode_obat' => 'required'
        ]);
        $masterobat = MasterObatModel::find($request->kode_obat);
        if(!$masterobat){
            return response()->json([
                'message'=>'gagal',
                'data'=>'data tidak ditemukan'
            ]);
        }
        $masterobat->delete();
        return response()->json([
            'message'=>'berhasil',
            "data"=>"Data Berhasil Di Hapus"
        ]);
    }
    /**
     * Mendapatkan daftar kode obat.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function kodeObat()
    {
        $data = MasterObatModel::select('kode_obat', 'nama_obat')
        ->where('flag_delete', 0)
        ->get();
        return response()->json([
            "message" => "Berhasil",
            "data" => $data
        ]);
    }
}
