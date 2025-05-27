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
        Schema::create('uas_transaksi_penjualans', function (Blueprint $table) {
            $table->id()->autoIncrement()->nullable(false)->primary()->unsigned();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('id_barang_jualan')->nullable(false);
            $table->unsignedBigInteger('jumlah_pembelian')->default(1)->nullable(false);
            $table->string('status')->nullable(false)->default('pending');
            $table->unsignedBigInteger('total_harga')->default(0)->nullable(false);
            $table->datetimes();
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("id_barang_jualan")->references("id")->on("uas_barang_jualans")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uas_transaksi_penjualans');
    }
};
