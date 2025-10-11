<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterObat extends Model
{
    use HasFactory;

    protected $table = 'master_obat';
    protected $primaryKey = 'kode_obat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'flag_delete'
    ];

    /**
     * Generate kode obat otomatis (OBT0001, OBT0002, dst)
     */
    public static function generateKodeObat()
    {
        // Ambil kode terakhir yang paling besar secara numerik
        $last = self::where('kode_obat', 'like', 'OBT%')
            ->orderByRaw('CAST(SUBSTRING(kode_obat, 4) AS UNSIGNED) DESC')
            ->first();

        if (!$last) {
            $number = 1;
        } else {
            // Ambil angka setelah prefix OBT
            $number = (int) substr($last->kode_obat, 3) + 1;
        }

        // Hasil akhir: OBT0001, OBT0002, OBT0100, dst.
        return 'OBT' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
