<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterSatuan as satuanObatModel;
use Illuminate\Validation\ValidationException;
class MasterSatuan extends Controller
{
    //
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function all(){
         $satuan = satuanObatModel::orderBy('id', 'desc')->get();
         return response()->json([
          "message"=>"berhasil",
          "data"=> $satuan
         ]);    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
       try{
            $request->validate([
                'satuan' => 'required|string|max:100',
            ]);
            // Membuat satuan obat baru
            // Manggunakan mass assignment
            satuanObatModel::create([
                'satuan' => $request->satuan,
            ]);
            
            return response()->json([
                "message" => "berhasil",
            ]);

        }catch(ValidationException $e){
            return response()->json([
                "message"=>"Pastikapn field terisi dengan benar",
            ],422);
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        try{
            $request->validate([
                'id' => 'required',
                'satuan' => 'required|string|max:100',
            ]);
            // Update satuan obat
            $satuan = satuanObatModel::find($request->id);
            if(!$satuan){
                return response()->json([
                    "message"=>"Satuan tidak ditemukan",
                ],404);
            }
            $satuan->satuan = $request->satuan;
            $satuan->save();
            return response()->json([
                "message"=>"berhasil diupdate",
            ]);
        }catch(ValidationException $e){
            return response()->json([
                "message"=>"Pastikapn field terisi dengan benar",
            ],422);
        }   

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSatuan(Request $request){
        try{
            $request->validate([
                'id' => 'required',
            ]);
            // Hapus satuan obat
            $satuan = satuanObatModel::find($request->id);
            if(!$satuan){
                return response()->json([
                    "message"=>"Satuan tidak ditemukan",
                ],404);
            }
            $satuan->delete();
            return response()->json([
                "message"=>"berhasil dihapus",
            ]);
        }catch(ValidationException $e){
            return response()->json([
                "message"=>"Pastikapn field terisi dengan benar",
            ],422);
        }   
    }
   
}
