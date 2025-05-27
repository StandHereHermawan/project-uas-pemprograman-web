<?php

namespace Database\Seeders;

use App\Models\BarangJualan;
use App\Models\StokBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangJualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 9; $i++) {
            $barangJualan = BarangJualan::factory()->create();
            StokBarang::factory()->state(["id_barang_jualan" => $barangJualan->id])->create();
        }
    }
}
