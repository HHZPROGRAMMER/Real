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
        Schema::create('emailverifications', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index(); // Emailni saqlash uchun
            $table->string('code');           // 6 xonali kodni saqlash uchun
            $table->timestamp('expires_at');  // Kodning amal qilish vaqti
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emailverifications');
    }
};
