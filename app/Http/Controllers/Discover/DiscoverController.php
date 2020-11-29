<?php

namespace App\Http\Controllers\Discover;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Role;

class DiscoverController extends Controller
{
    public function discover()
    {
        $users = User::where('id', '<>', auth()->id())->orderBy('created_at')->paginate(8);
        $roles = Role::all()->except([1,2]);

        if(\request()->ajax()) {
            $view = [];

            foreach($users as $user) {
                $view[] = view('components.user.item', compact('user'))->render();
            }

            return response()->json(['html' => $view]);
        }

        $role = \request()->role;
        if($role) {
            try {
                $role = Role::findByName($role);
            } catch(RoleDoesNotExist $exception) {
                flash()->error("Ce rôle n'existe pas");
                return view('discover', compact('users', 'roles'));
            }

            $users = User::role($role)->get()->paginate(8);
        }

        return view('discover', compact('users', 'roles'));
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
