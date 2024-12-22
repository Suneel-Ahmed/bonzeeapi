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
        Schema::create('payment_method_locks', function (Blueprint $table) {
            $table->id();
            $table->string('method'); // Payment method name (Easypaisa, JaazCash)
            $table->boolean('locked')->default(false); // Lock status (true for locked, false for unlocked)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_method_locks');
    }
};
