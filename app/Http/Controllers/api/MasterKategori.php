<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kategoriObat as kategoriObatModel;
use Illuminate\Validation\ValidationException;
class MasterKategori extends Controller
{
    //

    public function all(){
       $kategori = kategoriObatModel::orderBy('id', 'desc')->get();
       return response()->json([
        "message"=>"berhasil",
        "data"=> $kategori
       ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        try{
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
                'deskripsi' => 'required|string',
            ]);
            // Membuat kategori obat baru
            // Manggunakan mass assignment
            kategoriObatModel::create([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        try{
            $request->validate([
                'id' => 'required',
                'nama_kategori' => 'required',
                'deskripsi' => 'required',
            ]);
            $kategori = kategoriObatModel::find($request->id);
            if(!$kategori){
                return response()->json([
                    "message"=>"kategori tidak ditemukan"
                ],404);
            }
            $data= $request->all();
            $kategori->update($data);
            return response()->json([
                "message"=>"berhasil update kategori obat"
            ]);
        }catch(ValidationException $e){
            return response()->json([
                "message"=>"Pastikapn field terisi dengan benar",
            ],422);
        }
    }
    /**
     * 
     * Remove the specified resource from storage.
     */
    public function deleteKategori(Request $request){
        try{
            $request->validate([
                'id' => 'required',
            ]);
            $kategori = kategoriObatModel::find($request->id);
            if(!$kategori){
             return response()->json([
            'status'=>'Gagal',
            'message'=>'Gagal Melakukan Hapus Kategori Obat'
        ], 404);
            }
            $kategori->delete();
            return response()->json([
                "message"=>"berhasil menghapus kategori obat"
            ]); 
        }catch(\Exception $e){
            return response()->json([
                "message"=>"Gagal menghapus kategori obat"
            ],500);
        }
    }

}
