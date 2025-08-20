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
        Schema::table('participant_work_histories', function (Blueprint $table) {
            $table->text('country')->change();
            $table->text('period')->change();
            $table->text('target')->change();
            $table->text('reason_for_leaving')->nullable()->change();
            $table->text('remake')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participant_work_histories', function (Blueprint $table) {
            $table->string('country')->change();
            $table->string('period')->change();
            $table->string('target')->change();
            $table->string('reason_for_leaving')->nullable()->change();
            $table->string('remake')->nullable()->change();
        });
    }
};
