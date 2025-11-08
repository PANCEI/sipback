<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriObat extends Model
{
    use HasFactory;
     protected $table = 'master_kategori_medicine';
     protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];
}
