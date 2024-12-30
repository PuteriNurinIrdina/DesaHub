<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('event_module', function (Blueprint $table) {
        $table->dropColumn('user_id'); // Drop the column directly
    });
}

public function down()
{
    Schema::table('event_module', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable(); // Add the column back in case of rollback
    });
}
};
