<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('telegram_users', function (Blueprint $table) {
            $table->timestamp('last_active_at')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('telegram_users', function (Blueprint $table) {
        $table->dropColumn('last_active_at');
    });
}
};