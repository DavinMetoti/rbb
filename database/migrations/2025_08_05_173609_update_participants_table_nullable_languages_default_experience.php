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
            // Make language skills nullable
            $table->enum('cantonese', ['learning', 'basic', 'good'])->nullable()->change();
            $table->enum('mandarine', ['learning', 'basic', 'good'])->nullable()->change();
            $table->enum('english', ['learning', 'basic', 'good'])->nullable()->change();
            
            // Add default values to experience fields
            $table->integer('hongkong_year')->default(0)->change();
            $table->integer('singapore_year')->default(0)->change();
            $table->integer('taiwan_year')->default(0)->change();
            $table->integer('malaysia_year')->default(0)->change();
            $table->integer('brunei_year')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            // Revert language skills to non-nullable
            $table->enum('cantonese', ['learning', 'basic', 'good'])->nullable(false)->change();
            $table->enum('mandarine', ['learning', 'basic', 'good'])->nullable(false)->change();
            $table->enum('english', ['learning', 'basic', 'good'])->nullable(false)->change();
            
            // Remove default values from experience fields
            $table->integer('hongkong_year')->default(null)->change();
            $table->integer('singapore_year')->default(null)->change();
            $table->integer('taiwan_year')->default(null)->change();
            $table->integer('malaysia_year')->default(null)->change();
            $table->integer('brunei_year')->default(null)->change();
        });
    }
};
