<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->route('notification.index')->with('markAllAsRead', 'Toutes les notifications ont été effacées');
    }
}
