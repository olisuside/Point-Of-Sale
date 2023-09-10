<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_perusahaan' => 'TB SEMPULUR',
            'alamat' => 'Jl. Kibandang Samaran Ds. Slangit',
            'telepon' => '081234779987',
            'tipe_nota' => 1, // kecil
            'diskon' => 0,
            'path_logo' => '/img/logo.png',
            
        ]);
    }
}
