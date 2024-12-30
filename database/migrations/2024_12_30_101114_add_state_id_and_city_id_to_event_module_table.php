<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->unsignedBigInteger('state_id')->nullable(); // Assuming it references a state table
            $table->unsignedBigInteger('city_id')->nullable();  // Assuming it references a city table
        });
    }

    public function down()
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->dropColumn(['state_id', 'city_id']);
        });
    }
};
