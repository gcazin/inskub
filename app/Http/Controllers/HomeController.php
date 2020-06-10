<?php

namespace App\Http\Controllers;

use App\Post;
use App\Role;
use App\User;
use Illuminate\Contracts\Support\Renderable;

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

        return view('index', compact('posts'));
    }

    public function discover()
    {
        $user = User::all();
        $roles = Role::all()->except(1);
        return view('discover', compact('user', 'roles'));
    }

    public function discoverAll($role_id)
    {
        $role = Role::find($role_id);
        return view('discover-all', compact('role'));
    }

}
