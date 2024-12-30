<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('eventsss', 'event_module');
    }
    
    public function down()
    {
        Schema::rename('event_module', 'eventsss');
    }
    
};
