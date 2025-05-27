<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uas_stok_barangs', function (Blueprint $table) {
            $table->id()->autoIncrement()->nullable(false)->primary();
            $table->unsignedBigInteger("id_barang_jualan")->nullable(false);
            $table->unsignedBigInteger("jumlah")->nullable(false)->default(0);
            $table->foreign("id_barang_jualan")->references("id")->on("uas_barang_jualans")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uas_stok_barangs');
    }
};
