<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantWorkExperience extends Model
{
    protected $fillable = [
        'participant_id',
        'country',
        'years'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
