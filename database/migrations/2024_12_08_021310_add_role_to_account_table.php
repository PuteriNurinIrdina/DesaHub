<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToAccountTable extends Migration
{
    public function up()
    {
        Schema::table('account', function (Blueprint $table) {
            $table->string('role')->nullable(); // Add 'role' column without a default value
        });
    }

    public function down()
    {
        Schema::table('account', function (Blueprint $table) {
            $table->dropColumn('role'); // Remove 'role' column
        });
    }
}

