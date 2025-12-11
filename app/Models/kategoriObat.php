<?php

namespace App\Models;

use App\Http\Controllers\api\MasterObat;
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
       public function obat()
    {
        return $this->belongsToMany(
            MasterObat::class,
            'obat_kategori_relasi',
            'kategori_id',
            'kode_obat'
        );
    }
}
