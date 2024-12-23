<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_module', function (Blueprint $table) {
            // Check if columns exist before adding them
            if (!Schema::hasColumn('event_module', 'day_of_week')) {
                $table->string('day_of_week')->nullable();
            }
            if (!Schema::hasColumn('event_module', 'month')) {
                $table->string('month')->nullable();
            }
            if (!Schema::hasColumn('event_module', 'year')) {
                $table->string('year')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('event_module', function (Blueprint $table) {
            // Drop columns if they exist
            if (Schema::hasColumn('event_module', 'day_of_week')) {
                $table->dropColumn('day_of_week');
            }
            if (Schema::hasColumn('event_module', 'month')) {
                $table->dropColumn('month');
            }
            if (Schema::hasColumn('event_module', 'year')) {
                $table->dropColumn('year');
            }
        });
    }
};
