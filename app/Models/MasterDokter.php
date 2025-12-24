<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDokter extends Model
{
    use HasFactory;
    protected $table='master_dokter';
    protected $fillable = [
        'kode_dokter',
        'nama_dokter',
        'id_poli',
        'spesialis',
        'no_sip',
        'no_telp',
        'status_dokter',
        'flag_delete',
    ];
    public function getKodeDokter(){
        $last = self::where('kode_dokter', 'like', 'DKT%')
        ->orderByRaw('CAST(SUBSTRING(kode_dokter, 4) AS UNSIGNED) DESC')->first();
        if(!$last){
            $number = 1;
        }else{
            $number =(int) substr($last->kode_dokter, 3) +1;
        }
        return 'DKT'.str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
