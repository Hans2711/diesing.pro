<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('shared', function () {
    if (!session()->has('random_id')) {
        session(['random_id' => Str::random(8)]);
    }

    // Return array describing this "presence user"
    return ['id' => session('random_id')];
});

Broadcast::channel('client.{rId}', function ($rId) {
    // Only let someone join if their session's random_id matches {rId}
    return session('random_id') === $rId;
});
