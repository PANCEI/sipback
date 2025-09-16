<?php

namespace App\Http\Controllers\api;
use App\Models\Menu as MenuModel;
use App\Models\MenuAkses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Menu extends Controller
{
    public function index(Request $request)
    {
      
        // return response()->json([
        //     "status" => "berhasil",
        //     "message" => "Ini adalah endpoint API untuk menu."
        // ]);
$menus = MenuAkses::with('menu.submenus')
    ->where('id_akses', 1)
    ->get();
    return response()->json($menus);

    }
    public function all(Request $request)
    {
      $data = MenuModel::all();
        return response()->json([
            "status" => "berhasil",
            "data" => $data
        ]);
        
    // $menus = MenuAkses::with('menu.submenus')->get();
}
public function insert(Request $request)
{
//   $menu = new MenuModel();
//   $menu->nama_menu = $request->input('nama_menu');
//   $menu->icon = $request->input('icon');
//   $menu->link = $request->input('link');
//   $menu->is_main_menu = $request->input('is_main_menu');
//   $menu->urutan = $request->input('urutan');
//   $menu->save();

//     return response()->json([
//         "status" => "berhasil",
//         "message" => "Menu berhasil ditambahkan.",
//         "data" => $menu
//     ]);
        $request->validate([
            'menu' => 'required',
            'urutan' => 'required',
            'jenis' => 'required',
        ]);
    $menu = New MenuModel();
    $menu->menu=trim(htmlspecialchars(htmlentities($request->menu)));
    $menu->urutan= trim(htmlspecialchars(htmlentities($request->urutan)));
    $menu->jenis= trim(htmlspecialchars(htmlentities($request->jenis)));
    $menu->save();
    return response()->json([
        "status" => "berhasil",
        "message" => "Menu berhasil ditambahkan.",
        "data" => $menu
        ]);
    }
    public function delete(Request $request)
    {
        $menu = MenuModel::find($request->id);
        if (!$menu) {
            return response()->json([
                "status" => "gagal",
                "message" => "Menu tidak ditemukan."
            ], 404);
        }
        $menu->delete();
        return response()->json([
            "status" => "berhasil",
            "message" => "Menu berhasil dihapus."
        ]);
        // return response()->json([
        //     "status" => "berhasil",
        //     "message" => $menu
        // ]);
    }
public function update(Request $request)
{
    $menu = MenuModel::find($request->id);

    if (!$menu) {
        return response()->json([
            "status" => "gagal",
            "message" => "Menu tidak ditemukan."
        ], 404);
    }
    
   
     $dataToUpdate = [
        'menu' => trim(htmlspecialchars(htmlentities($request->menu))),
        'urutan' => trim(htmlspecialchars(htmlentities($request->urutan))),
        'jenis' => trim(htmlspecialchars(htmlentities($request->jenis))),
    ];
    $menu->update($dataToUpdate);

    return response()->json([
        "status" => "berhasil",
        "message" => "Menu berhasil diperbarui.",
        "data" => $menu
    ]);
}
}
