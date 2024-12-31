<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_module', function (Blueprint $table) {
            // Add state_id and city_id columns
            $table->unsignedMediumInteger('state_id')->nullable();
            $table->unsignedMediumInteger('city_id')->nullable();

            // Add state_name and city_name columns to store the names directly
            $table->string('state_name')->nullable();
            $table->string('city_name')->nullable();

            // Optional: Add foreign key constraints
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('event_module', function (Blueprint $table) {
            // Drop the columns and foreign keys if rolling back
            $table->dropForeign(['state_id']);
            $table->dropForeign(['city_id']);
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
            $table->dropColumn('state_name');
            $table->dropColumn('city_name');
        });
    }
};