<?php

namespace App\Http\Livewire;

use App\Post;
use App\User;
use Livewire\Component;

class LikePost extends Component
{
    public $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function addLike()
    {
        $post = Post::find($this->post->id);
        auth()->user()->toggleLike($post);
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
