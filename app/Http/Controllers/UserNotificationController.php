<?php

namespace App\Http\Controllers;

class UserNotificationController extends Controller
{
    public function show()
    {
        $notifications = auth()->user()->unReadNotifications;
        $notifications->markAsRead();
        return view('Notifications.show', ['notifications' => $notifications]);
    }
}
