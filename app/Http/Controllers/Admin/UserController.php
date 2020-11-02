<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('admin.user.index');
    }
}
