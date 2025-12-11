<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatKatergoriRelasi extends Model
{
    use HasFactory;
    protected $table = 'obat_kategori_relasi';
    protected $fillable = [
        'kode_obat',
        'kategori_id',
    ];

}
