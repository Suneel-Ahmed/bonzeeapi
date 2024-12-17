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
        Schema::create('user_task_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->boolean('is_verified')->default(false); // To store the verification status
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('telegram_users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('offical_tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_task_statuses');
    }
};
