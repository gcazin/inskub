<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ReportingPost;

class AdminController extends Controller
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Page d'administration
     *
     * @return string|void
     */
    public function index()
    {
        $users = $this->user::all();

        /*$users = $users
            ->whereNotNull('created_at')
            ->whereBetween('created_at', [
                Carbon::make(now())->startOfYear(),
                Carbon::make(now())->endOfYear()
            ])
            ->sortBy('created_at')
            ->map(function ($user) {
                return collect($user->toArray())->only('created_at')->all();
            })
            ->map(function ($value) {
                return (int) Carbon::make($value['created_at'])->format('m');
            })
        ;*/

        return view('admin.index', compact('users'));
    }

    public function reports()
    {
        $user = $this->user::find(1);

        $notifications = $user->notifications->where('type', '=', ReportingPost::class);

        return view('admin.reports', compact('notifications'));
    }

}
