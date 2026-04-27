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
        Schema::table('users', function (Blueprint $table) {
            // Changes the 'role' column to tinyInteger with a default value of 0
            $table->tinyInteger('role')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverts the 'role' column back to string with a default value of 'user'
            $table->string('role')->default('user')->change();
        });
    }
};
