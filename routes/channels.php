<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
<<<<<<< HEAD
=======

Broadcast::channel('messages.{receiverId}', function($user, $receiverId) {
    return $user->id === (int) $receiverId;
});
>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f
