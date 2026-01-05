<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUpObat extends Model
{
    use HasFactory;
    protected $table= "checkup_obat";
    protected $fillable = [
        "id_pemeriksaan",
        "id_obat",
        "dokter",
        "dosis",
        "jumlah",
        "tanggal_pemeriksaan_dokter",
        "tanggal_penyerahan_obat"
    ];
}
