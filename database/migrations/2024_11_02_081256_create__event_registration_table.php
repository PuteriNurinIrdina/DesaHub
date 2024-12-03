<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('_event_registration', function (Blueprint $table) {
            $table->id();
            $table->string('ic_num');
            $table->string('name');
            $table->string('phone_num');
            $table->string('gender');
            $table->text('address');
            $table->string('poscode');
            $table->string('email')->nullable();
            $table->string('state');
            $table->string('house_category');
            $table->string('age_class');
            $table->boolean('attendance')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_event_registration');
    }
};
