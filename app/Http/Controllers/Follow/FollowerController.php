<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class FollowerController extends Controller {
    public function add(Request $request)
    {
        if($request->ajax()) {
            $user = User::find(auth()->user()->id);
            $user->toggleFollow($request->get('user_id'));
            return response()->json();
        }
        return response()->json();
    }
}
