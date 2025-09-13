<?php

namespace Database\Seeders;

use App\Models\Akses as ModelsAkses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Akses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akses = [
            [
                "akses"=>"ADMIN"
            ],
            [
                "akses"=>"PETUGAS"
            ],
           
        ];
        foreach ($akses as $aks) {
            # code...
            ModelsAkses::create($aks);
        }
    }
}
