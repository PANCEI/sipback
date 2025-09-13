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
}
