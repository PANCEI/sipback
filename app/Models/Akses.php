<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    use HasFactory;
     protected $fillable = [
        'akses', // Tambahkan kolom ini
        // Tambahkan semua kolom lain yang ingin Anda izinkan untuk diupdate
    ];
    
}
