<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function checkNotifications($userId)
    {
        // Fetch the notifications for the given user
        $notifications = DB::table('notifications')
            ->where('notifiable_id', $userId)
            ->get();

        // Optionally, return the notifications to a view or for debugging
        return view('notifications.index', compact('notifications'));
    }

    public function deleteAll()
    {
        // Delete all notifications for the authenticated user
        auth()->user()->notifications()->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'All notifications deleted successfully.');
    }


}
