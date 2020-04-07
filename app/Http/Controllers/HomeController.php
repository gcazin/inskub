<?php

namespace App\Http\Controllers;

use App\Article;
use App\Role;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function discover()
    {
        $user = User::all();
        $roles = Role::all()->except(1);
        return view('discover', compact('user', 'roles'));
    }

}
