<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->time('event_time')->nullable();  // Add the 'event_time' column
        });
    }

    public function down()
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->dropColumn('event_time');  // Remove the 'event_time' column if rollback
        });
    }
};
