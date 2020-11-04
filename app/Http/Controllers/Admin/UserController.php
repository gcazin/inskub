<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->filled('department_id') ? $request->department_id : null,
            'company_id' => $request->filled('company_id') ? $request->company_id : null,
            'created_at' => now(),
        ]);
        $user->assignRole($request->role_name);

        return redirect()->route('admin.user.index');
    }
}
