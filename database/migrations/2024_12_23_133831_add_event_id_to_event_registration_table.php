<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventIdToEventRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('_event_registration', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->nullable()->after('id'); // Add after 'id' for better structure
            $table->foreign('event_id')->references('id')->on('event_module')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('_event_registration', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }
}
