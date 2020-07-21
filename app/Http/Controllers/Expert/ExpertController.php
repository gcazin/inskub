<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = DB::table('users')->where('role_id', '=', 2)->paginate(10);

        return view('experts-list', compact('experts'));
    }
}
