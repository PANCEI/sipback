<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAkses extends Model
{
    use HasFactory;
    protected $table = 'menuakses';
    public function menu() { 
        return $this->belongsTo(Menu::class, 'id_menu'); 
    }

}

