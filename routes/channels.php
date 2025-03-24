<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['web', 'auth']]);

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('public-online-users', function () {
    return true;
});

Broadcast::channel('user.{receiverId}', function ($user, $receiverId) {
    return $user->email === $receiverId.'@guest.local';
});
