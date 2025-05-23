<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswas')->insert([
            "nama" => "Acep Hendra",
            "npm" => '123121001',
            "jurusan" => 'Sistem Informasi',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }
}
