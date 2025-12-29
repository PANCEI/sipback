<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanPasien extends Model
{
    use HasFactory;
    protected $table= 'master_pasien';
    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'sistolik',
        'diastolik',
        'keluhan'
    ];
}
