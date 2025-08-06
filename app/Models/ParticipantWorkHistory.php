<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantWorkHistory extends Model
{
    protected $fillable = [
        'participant_id',
        'country',
        'period',
        'target',
        'reason_for_leaving',
        'remake',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
