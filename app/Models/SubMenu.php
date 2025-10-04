<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class SubMenu extends Model
{
    use HasFactory;
    protected $table = 'submenu';
    protected $fillable=[
        "icon",
        "id_menu",
        "nama_sub_menu",
        "path",
        "url",
        'sub'
    ];
    public function Menu (){
        return $this->belongsTo(Menu::class, 'id_menu');
    }
 public static function getWithMenu()
{
    // return self::join('menu', 'submenu.id_menu', '=', 'menu.id')
    //            ->select(
    //                'submenu.*',
    //                'menu.menu as menu_nama',
    //                DB::raw("CASE WHEN submenu.sub IS NOT NULL THEN 'YA' ELSE 'TIDAK' END as sub_status")
    //            )
    //            ->get();
    return self::join('menu', 'submenu.id_menu', '=', 'menu.id')
           ->select(
               'submenu.id',
               'submenu.id_menu',
               'submenu.nama_sub_menu',
               'submenu.icon',
               'submenu.path',
               'submenu.url',
               'menu.menu as menu_nama',
               DB::raw("CASE WHEN submenu.sub IS NOT NULL THEN 'Ya' ELSE 'Tidak' END as sub")
           )
           ->orderBy('submenu.id', 'desc') // atau field lain sesuai kebutuhan
             ->get();
}

}
