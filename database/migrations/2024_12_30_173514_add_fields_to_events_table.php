<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->integer('max_participants')->nullable();
        });
    }

    public function down()
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->dropColumn(['address', 'max_participants']);
        });
    }

};
