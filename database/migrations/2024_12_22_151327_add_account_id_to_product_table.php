<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountIdToProductTable extends Migration
{
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->after('id'); // Adjust the position with 'after' if needed
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });
    }
}
