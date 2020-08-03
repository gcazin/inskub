<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\User;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = User::where('role_id', '=', 2)->paginate(20);

        return view('experts-list', compact('experts'));
    }
}
