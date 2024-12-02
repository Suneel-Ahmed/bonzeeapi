<?php

use App\Models\Level;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('telegram_id')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('ton_wallet')->nullable();
            $table->integer('balance')->default(0);
            $table->integer('login_streak')->default(0);
            $table->unsignedBigInteger('referred_by')->nullable();
            $table->foreignIdFor(Level::class)->default(1);
            $table->rememberToken();
            $table->dateTime('last_login_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('telegram_users');
    }
};
