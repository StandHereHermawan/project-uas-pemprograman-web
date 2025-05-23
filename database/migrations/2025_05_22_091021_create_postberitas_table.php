<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return
 new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('isi');
            $table->string('penulis');
            $table->string('layak_publish');
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->foreign("id_mahasiswa")->references("id")->on("mahasiswas")->cascadeOnUpdate()->cascadeOnDelete();
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_beritas');
    }
};
