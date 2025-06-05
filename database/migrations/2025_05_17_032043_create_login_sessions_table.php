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
        Schema::create('uas_login_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unsigned()->primary()->autoIncrement();
            $table->string('email')->unique();
            $table->dateTime('expired_at');
            $table->foreign("email")->references("email")->on("uas_users")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uas_login_sessions');
    }
};
