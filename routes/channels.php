<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('withdrawal.{withdrawal}',
    function ($user, \App\Models\WithDrawal $withdrawal) {
        return $withdrawal->account->user_account_user_id === $user->id;
    });

Broadcast::Channel('room', function ($user) {
    if (true) {
        return ['name' => $user->name];
    }
});