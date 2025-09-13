<?php

namespace Database\Seeders;

use App\Models\AksesUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAkses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAkses= [
            [
                "id_user"=>1,
                "id_akses"=>1
            ]
        ];
        foreach($userAkses as $uaks){
            AksesUser::create($uaks);
        }
    }
}
