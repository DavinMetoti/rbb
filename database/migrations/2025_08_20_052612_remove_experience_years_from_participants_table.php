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
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn([
                'hongkong_year',
                'singapore_year', 
                'taiwan_year',
                'malaysia_year',
                'brunei_year'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->integer('hongkong_year')->default(0);
            $table->integer('singapore_year')->default(0);
            $table->integer('taiwan_year')->default(0);
            $table->integer('malaysia_year')->default(0);
            $table->integer('brunei_year')->default(0);
        });
    }
};
