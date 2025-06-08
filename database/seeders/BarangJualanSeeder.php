<?php

namespace Database\Seeders;

use App\Models\BarangJualan;
use App\Models\StokBarang;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangJualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 90; $i++) {
            $user = User::factory()
                ->create();

            $barangJualan = BarangJualan::factory()
                ->state(['seller_id' => $user->getId()])
                ->create();

            StokBarang::factory()
                ->state(["id_barang_jualan" => $barangJualan->id])
                ->create();
        }
    }
}
