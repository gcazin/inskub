<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Musonza\Chat\Chat;

class ExpertController extends Controller
{
    /**
     * @var Chat
     */
    private Chat $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function index()
    {
        $experts = User::role('expert')->orderBy('created_at')->paginate(8);

        if(\request()->ajax()) {
            $view = [];
            foreach($experts as $user) {
                $view[] = view('components.user.item', compact('user'))->render();
            }

            return response()->json(['html' => $view]);
        }

        return view('expert.index', compact('experts'));
    }

    public function search(Request $request)
    {
        if($request->ajax()) {
            $users = [];
            $view = [];

            foreach($request->skills as $skill) {
                $users[] = User::whereHas('skills', function(Builder $query) use ($skill) { $query->where('skill_id', $skill); })
                    ->when($request->departments, fn(Builder $query, $department) => $query->where('department_id', $department))
                    ->when($request->companies, fn(Builder $query, $company) => $query->where('company_id', $company))
                    ->get();
            }

            foreach($users[0] as $user) {
                $view[] = view('components.user.item', compact('user'))->render();
            }

            return response()->json(['html' => $view]);
        }
    }
}
