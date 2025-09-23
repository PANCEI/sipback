<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAkses extends Model
{
    use HasFactory;
    protected $table = 'menuakses';
    protected $fillable = [
        'id_menu', // Tambahkan kolom ini
        'id_akses',   // Tambahkan kolom ini
       
    ];
    public function menu() { 
        return $this->belongsTo(Menu::class, 'id_menu'); 
    }

}

