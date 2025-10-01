<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;
    protected $table = 'submenu';
    public function Menu (){
        return $this->belongsTo(Menu::class, 'id_menu');
    }
    public static function getWithMenu()
{
    return self::join('menu', 'submenu.id_menu', '=', 'menu.id')
               ->select('submenu.*', 'menu.menu as menu_nama')
               ->get();
}

}
