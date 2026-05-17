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
        Schema::create('task_histories', function (Blueprint $row) {
            $row->id();
            $row->foreignId('task_id')->nullable()->constrained()->onDelete('set null');
            $row->foreignId('user_id')->constrained()->cascadeOnDelete();
            $row->string('action');
            $row->text('description');
            $row->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_histories');
    }
};
