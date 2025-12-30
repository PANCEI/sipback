<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanPasien extends Model
{
    use HasFactory;
    protected $table= 'pemeriksaan_pasien';
    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'sistolik',
        'diastolik',
        'keluhan',
        'tanggal_pemeriksaan',
        'diagnosa'
    ];
    public function pasien(){
        return $this->belongsTo(
            MasterPasien::class, 
            'id_pasien',
            'id'
        );
    }
}
