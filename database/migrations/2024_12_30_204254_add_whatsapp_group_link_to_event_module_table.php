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
        Schema::table('event_module', function (Blueprint $table) {
            $table->string('whatsapp_group_link')->nullable(); // Add the whatsapp_group_link column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_module', function (Blueprint $table) {
            $table->dropColumn('whatsapp_group_link'); // Drop the column if we roll back
        });
    }
};
