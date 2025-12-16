<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMitra extends Model
{
    use HasFactory;
      protected $table = 'master_mitra';
      protected $primaryKey = 'kode_mitra';
       protected $keyType = 'string';
    protected $fillable = [
        'kode_mitra',
        'nama_mitra',
        'alamat',
        'no_telepon',
        'flag_delete'
    ];
    /**
     * generate kode mitra
     * 
     * 
     */
    public static function generateKodeMitra(){
        $last = self::where('kode_mitra', 'like' , 'MTRA%')
                ->orderByRaw('CAST(SUBSTRING(kode_mitra, 5  ) AS UNSIGNED) DESC')->first();
        if(!$last){
            $number = 1;
        }else{
               $number = (int) substr($last->kode_mitra, 4) + 1;
        }
        return 'MTRA' . str_pad($number, 4 , '0', STR_PAD_LEFT);
    }
}
