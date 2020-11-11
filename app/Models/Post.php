<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model
{
    use CanBeLiked, InteractsWithMedia;

    protected $fillable = [
        'content', 'user_id', 'visibility_id',
    ];

    /**
     * Get the comments for the blog post.
     */
    public function replies()
    {
        return $this->hasMany(Reply_post::class);
    }

    /**
     * Les posts appartiennent à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('posts');
    }
}
