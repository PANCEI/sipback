<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPasien extends Model
{
    use HasFactory;
    protected $table= "master_pasien";
    protected $fillable = [
        'no_rm',
        'nama_pasien',
        'alamat',
        'deskripsi',
        'tanggal_lahir',
        'flag_delete'
    ];

}
