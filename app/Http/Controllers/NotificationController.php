<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($notificationId)
{
    $notification = auth()->user()->notifications()->findOrFail($notificationId);
    $notification->markAsRead();
    $this->read_at = now(); // Set read_at to the current timestamp
    //$this->save(); // Save the changes to the database

    return back();
}
}
