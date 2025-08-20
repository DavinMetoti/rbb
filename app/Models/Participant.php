<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';

    protected $fillable = [
        'code',
        'name',
        'gender',
        'birth_date',
        'nationality',
        'height',
        'weight',
        'religion',
        'marital_status',
        'education',
        'no_of_children',
        'status',
        'hongkong_year',
        'singapore_year',
        'taiwan_year',
        'malaysia_year',
        'brunei_year',
        'cantonese',
        'mandarine',
        'english',
        'elderly_healthy_care_experience',
        'elderly_sick_care_experience',
        'elderly_healthy_care_experience_v',
        'elderly_sick_care_experience_v',
        'newborn_care_experience',
        'children_care_experience',
        'i_can_take_care_of_dog',
        'i_can_take_care_of_cat',
        'cooking_cleaning_washing_ironing_go_to_market',
        'i_can_wash_car',
        'shuttle_school',
        'assist_toileting_change_diaper_bath_experience',
        'go_to_hospital_handle_medication_experience',
        'do_exercise',
        'use_wheelchair',
        'provide_daily_assistance',
        'oral_feeding',
        'with_dementia_care_experience',
        'assist_walking',
        'received_covid19_vaccine_injection_3_dose',
        'i_can_inject_diabetes',
        'i_can_take_care_of_idiots',
        'suction_phlegm_ican_do_it',
        'i_like_take_care_of_a_children',
        'i_like_take_care_of_a_newborn_baby',
        'i_like_take_care_of_the_elderly',
        'photo_path',
        'new_job',
        'date',
        'is_public',
    ];

    public function workHistories()
    {
        return $this->hasMany(ParticipantWorkHistory::class);
    }
}
