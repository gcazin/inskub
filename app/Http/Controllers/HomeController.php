<?php

namespace App\Http\Controllers;

use App\Post;
use App\Role;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $posts = User::find(auth()->id())->posts;

        $posts_followings = User::find(auth()->id())->followings->map(static function($user) {
            return Post::where('user_id', $user->id)->where('visibility_id', '<>', 3)->where('project_id', '==', 'NULL')->get();
        });

        $posts = $posts->merge($posts_followings->collapse())->sortByDesc('created_at');

        $user = User::class;
        return view('index', compact('posts', 'user'));
    }

    public function discover()
    {
        $user = User::all();
        $roles = Role::all()->except(1);
        return view('discover', compact('user', 'roles'));
    }

}
