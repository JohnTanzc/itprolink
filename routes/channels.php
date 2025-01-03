<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user.{receiverId}', function ($user, $receiverId) {
    // Check if the authenticated user is the receiver of the message
    return (int) $user->id === (int) $receiverId;
});
