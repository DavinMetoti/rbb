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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('birth_date');
            $table->string('nationality');
            $table->integer('height');
            $table->integer('weight');
            $table->string('religion');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->string('education');
            $table->string('no_of_children')->nullable();
            $table->string('status');
            $table->integer('hongkong_year');
            $table->integer('singapore_year');
            $table->integer('taiwan_year');
            $table->integer('malaysia_year');
            $table->integer('brunei_year');
            $table->enum('cantonese', ['learning', 'basic','good']);
            $table->enum('mandarine', ['learning', 'basic','good']);
            $table->enum('english', ['learning', 'basic','good']);
            $table->boolean('elderly_healthy_care_experience')->default(false);
            $table->boolean('elderly_sick_care_experience')->default(false);
            $table->boolean('elderly_healthy_care_experience_v')->default(false);
            $table->boolean('elderly_sick_care_experience_v')->default(false);
            $table->boolean('newborn_care_experience')->default(false);
            $table->boolean('children_care_experience')->default(false);
            $table->boolean('i_can_take_care_of_dog')->default(false);
            $table->boolean('i_can_take_care_of_cat')->default(false);
            $table->boolean('cooking_cleaning_washing_ironing_go_to_market')->default(false);
            $table->boolean('i_can_wash_car')->default(false);
            $table->boolean('shuttle_school')->default(false);
            $table->boolean('assist_toileting_change_diaper_bath_experience')->default(false);
            $table->boolean('go_to_hospital_handle_medication_experience')->default(false);
            $table->boolean('do_exercise')->default(false);
            $table->boolean('use_wheelchair')->default(false);
            $table->boolean('provide_daily_assistance')->default(false);
            $table->boolean('oral_feeding')->default(false);
            $table->boolean('with_dementia_care_experience')->default(false);
            $table->boolean('assist_walking')->default(false);
            $table->boolean('received_covid19_vaccine_injection_3_dose')->default(false);
            $table->boolean('i_can_inject_diabetes')->default(false);
            $table->boolean('i_can_take_care_of_idiots')->default(false);
            $table->boolean('suction_phlegm_ican_do_it')->default(false);
            $table->boolean('i_like_take_care_of_a_children')->default(false);
            $table->boolean('i_like_take_care_of_a_newborn_baby')->default(false);
            $table->boolean('i_like_take_care_of_the_elderly')->default(false);
            $table->string('photo_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
