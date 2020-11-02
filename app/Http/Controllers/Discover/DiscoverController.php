<?php

namespace App\Http\Controllers\Discover;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function discover()
    {
        $users = User::where('id', '<>', auth()->id())->orderBy('created_at')->paginate(8);

        if(\request()->ajax()) {
            $view = [];

            foreach($users as $user) {
                $view[] = view('components.user.item', compact('user'))->render();
            }

            return response()->json(['html' => $view]);
        }

        return view('discover', compact('users'));
    }

    public function discoverAll($role_id)
    {
        $role = Role::find($role_id);
        return view('discover-all', compact('role'));
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $view = [];
        if(\request()->ajax()) {
            $initial = false;

            if($q) {
                $users = User::where('first_name', 'LIKE','%'.$q.'%')->get();
            } else {
                $users = User::where('id', '<>', auth()->id())->paginate(8);
                $initial = true;
            }

            foreach($users as $user) {
                $view[] = view('components.user.item', compact('user'))->render();
            }

            return response()->json(['html' => $view, 'initial' => $initial]);
        }
    }
}
