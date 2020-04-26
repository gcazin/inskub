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
        $posts = Post::all();
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
