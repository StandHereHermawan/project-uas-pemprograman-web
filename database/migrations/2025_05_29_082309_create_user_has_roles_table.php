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
        Schema::create('uas_user_has_roles', function (Blueprint $table) {
            $table->id()->unsigned()->autoIncrement()->primary();
            $table->unsignedBigInteger('role_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign("role_id")->references("id")->on("uas_roles")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("user_id")->references("id")->on("uas_users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uas_user_has_roles');
    }
};
