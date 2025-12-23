<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPoli extends Model
{
    use HasFactory;
    protected $table = 'master_poli';
    public static function generateKodePoli(){
        $last = self::where('kode_poli', 'like' , 'PLI%')
        ->orderByRaw('CAST(SUBSTRING(kode_poli, 4) AS UNSIGNED) DESC')->first();
        if(!$last){
            $number = 1;
        }else{
               $number = (int) substr($last->kode_poli, 3) + 1;
        }
        return 'PLI' . str_pad($number, 4 , '0', STR_PAD_LEFT); 
    }
}