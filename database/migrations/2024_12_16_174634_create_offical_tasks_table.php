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
        Schema::create('offical_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Task name
            $table->string('image')->nullable(); // Optional image for the task
            $table->string('link'); // Task link
            $table->string('code'); // Code for verification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offical_tasks');
    }
};
