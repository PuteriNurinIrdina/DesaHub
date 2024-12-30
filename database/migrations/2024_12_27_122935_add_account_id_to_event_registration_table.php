<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountIdToEventRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('_event_registration', function (Blueprint $table) {
            // Add account_id column
            $table->unsignedBigInteger('account_id')->nullable()->after('event_id');
            
            // Add foreign key constraints
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
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
            // Drop foreign key and column
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });
    }
}