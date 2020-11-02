<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestExpertise extends Model
{
    protected $table = 'request_expertises';

    public const CURRENT_STATUS = 0;
    public const ACCEPT_STATUS = 1;
    public const REFUSE_STATUS = 2;

    protected $fillable = [
        'sender_id', 'expert_id', 'project_id', 'conversation_id', 'accepted'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }
}
