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
        Schema::table('participant_work_experiences', function (Blueprint $table) {
            // Change years column from integer to string
            $table->string('years')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participant_work_experiences', function (Blueprint $table) {
            // Revert years column back to integer
            $table->integer('years')->default(0)->change();
        });
    }
};
