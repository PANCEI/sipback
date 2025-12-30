<?php

namespace App\Models;

use App\Http\Controllers\api\PemeriksaanPasien;
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
    public static function generateRm(){
        $last = self::where('no_rm', 'like', 'RM-%')
            ->orderByRaw('CAST(SUBSTRING(no_rm, 4) AS UNSIGNED) DESC')
            ->first();
         if (!$last) {
            $number = 1;
        } else {
          
            $number = (int) substr($last->no_rm, 3) + 1;
            
        }
           return 'RM-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
    public function pemeriksaan(){
        return $this->hasMany(
            PemeriksaanPasien::class,
            'id_pasien',
            'id'
        );
    }
}
