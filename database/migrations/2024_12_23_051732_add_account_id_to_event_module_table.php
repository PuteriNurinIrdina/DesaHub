<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountIdToEventModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable()->after('id'); // Add the column
            $table->foreign('account_id') // Set up the foreign key constraint
                  ->references('id')
                  ->on('account')
                  ->onDelete('set null'); // Optional: Handle deletions
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->dropForeign(['account_id']); // Remove the foreign key
            $table->dropColumn('account_id');   // Remove the column
        });
    }
}
