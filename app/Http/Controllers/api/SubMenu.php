<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu as SubMenuModel;

class SubMenu extends Controller
{
    public function show(){
        $data= SubMenuModel::getWithMenu();
    return response()->json([
        'status'=>'Berhasil',
        'message'=>'Data Berhasil Di Temukan',
        "data"=>$data
    ]);
    }
}
