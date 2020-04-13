<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

class Post extends Model
{
    use CanBeLiked;

    protected $fillable = [
        'content', 'user_id', 'visibility_id',
    ];

    /**
     * Get the comments for the blog post.
     */
    public function replies()
    {
        return $this->hasMany('App\Reply_post');
    }
}
