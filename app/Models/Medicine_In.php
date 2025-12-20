<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine_In extends Model
{
    use HasFactory;
    protected $table = 'log_medicine_in';
    protected $fillable = [
        'kode_obat',
        'jumlah_masuk',
        'kode_mitra',
        'tanggal_masuk',
        'tanggal_kadaluarsa',
        'keterangan',
        'created_by',
    ];
}
    