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
    public static function getKodeDokter(){
        $last = self::where('kode_dokter', 'like', 'DKT%')
        ->orderByRaw('CAST(SUBSTRING(kode_dokter, 4) AS UNSIGNED) DESC')->first();
        if(!$last){
            $number = 1;
        }else{
            $number =(int) substr($last->kode_dokter, 3) +1;
        }
        return 'DKT'.str_pad($number, 4, '0', STR_PAD_LEFT);
    }
    public static function generateNoSIP()
    {
        // Ambil tahun saat ini
        $year = date('Y');
        $prefix = 'SIP' . $year;

        // Cari nomor SIP terakhir di tahun yang sama
        $last = self::where('no_sip', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTRING(no_sip, 8) AS UNSIGNED) DESC')
            ->first();

        if (!$last) {
            // Jika belum ada SIP di tahun ini, mulai dari 1
            $number = 1;
        } else {
            // Jika sudah ada, ambil angka terakhir (dimulai dari karakter ke-8) dan tambah 1
            $number = (int) substr($last->no_sip, 7) + 1;
        }

        // Return format SIP + TAHUN + 4 digit nomor urut (Contoh: SIP20230001)
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
