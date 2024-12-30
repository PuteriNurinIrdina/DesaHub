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
        Schema::table('event_module', function (Blueprint $table) {
            $table->string('day_of_week')->nullable(); // e.g., Monday, Tuesday
            $table->string('month')->nullable(); // e.g., January, February
            $table->integer('year')->nullable(); // e.g., 2024
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
