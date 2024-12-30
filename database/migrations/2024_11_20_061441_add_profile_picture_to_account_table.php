<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilePictureToAccountTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('account', function (Blueprint $table) {
        if (!Schema::hasColumn('account', 'profile_picture')) {
            $table->string('profile_picture')->nullable()->after('ig');
        }
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account', function (Blueprint $table) {
            $table->dropColumn('profile_picture'); // Remove the column if rolled back
        });
    }
}