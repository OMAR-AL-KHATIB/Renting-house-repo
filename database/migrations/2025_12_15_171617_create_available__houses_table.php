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
        Schema::create('available__houses', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_available');
            $table->dateTime('expire_at');
            $table->string('government');
            $table->string('city');
            $table->string('details');
            $table->integer('price');
            $table->string('image');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available__houses');
    }
};
