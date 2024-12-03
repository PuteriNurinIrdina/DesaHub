<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttendanceToEventRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('_event_registration', function (Blueprint $table) {
            $table->boolean('attendance')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('_event_registration', function (Blueprint $table) {
            $table->dropColumn('attendance');
        });
    }
}
