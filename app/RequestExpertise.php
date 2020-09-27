<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestExpertise extends Model
{
    protected $table = 'request_expertises';

    protected $fillable = [
        'sender_id', 'expert_id', 'accepted'
    ];
}
