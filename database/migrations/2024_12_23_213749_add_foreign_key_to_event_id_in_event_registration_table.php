<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToEventIdInEventRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('_event_registration', function (Blueprint $table) {
            // Add foreign key to the existing event_id column
            $table->foreign('event_id')->references('id')->on('event_module')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_event_registration', function (Blueprint $table) {
            // Drop the foreign key
            $table->dropForeign(['event_id']);
        });
    }
}
