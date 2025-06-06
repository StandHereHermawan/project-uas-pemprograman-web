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
        Schema::create('uas_roles', function (Blueprint $table) {
            $table->id()->unsigned()->autoIncrement()->primary();
            $table->string('role')->unique()->nullable(false)->default('CUSTOMER');
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uas_roles');
    }
};
