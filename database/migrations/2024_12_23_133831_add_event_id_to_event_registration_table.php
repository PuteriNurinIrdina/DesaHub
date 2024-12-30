<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventIdToEventRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('_event_registration', function (Blueprint $table) {
            // Adding the event_id column and making it nullable
            $table->unsignedBigInteger('event_id')->nullable()->after('id'); 

            // Foreign key constraint for event_id referencing event_module table
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
            // Dropping the foreign key and column when rolling back migration
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }
}
