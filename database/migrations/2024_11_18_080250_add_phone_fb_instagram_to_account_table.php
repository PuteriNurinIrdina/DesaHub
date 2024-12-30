<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneFbInstagramToAccountTable extends Migration
{
    public function up()
    {
        Schema::table('account', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('fb')->nullable();
            $table->string('ig')->nullable();
            $table->string('profile_picture')->nullable();
        });
    }

    public function down()
    {
        Schema::table('account', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('fb');
            $table->dropColumn('ig');
            $table->dropColumn('profile_picture');
        });
    }
}