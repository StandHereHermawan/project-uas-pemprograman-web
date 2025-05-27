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
        Schema::create('uas_barang_jualans', function (Blueprint $table) {
            $table->id()->autoIncrement()->nullable(false)->primary()->unsigned();
            $table->string("nama_barang")->nullable(false);
            $table->unsignedBigInteger("harga")->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uas_barang_jualans');
    }
};
