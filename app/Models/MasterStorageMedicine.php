<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStorageMedicine extends Model
{
    use HasFactory;
     protected $table = 'master_storage_medicine';
     protected $fillable = [
        'kode_obat',
        'quantity'
     ];

}
