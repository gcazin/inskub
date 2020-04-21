<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply_post extends Model
{
    protected $table = 'reply_posts';

    protected $fillable = [
        'message', 'post_id', 'user_id',
    ];

    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
