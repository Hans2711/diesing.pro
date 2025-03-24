<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Cache;

Route::middleware('api')->group(function () {
    Route::post('/presence/join', function (Request $request) {
        $request->validate(['userId' => 'required|string']);
        $userId = $request->post('userId');

        // Retrieve or create active users array
        $activeUsers = Cache::get('active_users', []);

        // Add or refresh user with current timestamp
        $activeUsers[$userId] = now()->timestamp;

        Cache::put('active_users', $activeUsers, now()->addMinutes(10));

        broadcast(new \App\Events\UserPresenceEvent('join', $userId));

        // Cleanup old users (older than 10 mins)
        $activeUsers = array_filter($activeUsers, fn($ts) => $ts > now()->subMinutes(10)->timestamp);
        Cache::put('active_users', $activeUsers, now()->addMinutes(10));

        return response()->json([
            'status' => 'joined',
            'active_users' => array_keys($activeUsers),
        ]);
    });

    Route::post('/presence/leave', function (Request $request) {
        $userId = $request->post('userId');

        $activeUsers = Cache::get('active_users', []);
        unset($activeUsers[$userId]);
        Cache::put('active_users', $activeUsers, now()->addMinutes(10));

        broadcast(new \App\Events\UserPresenceEvent('leave', $userId));

        return response()->json(['status' => 'left']);
    });

    Route::post('/send-data', function (Request $request) {
        $request->validate([
            'userId' => 'required|string',     // Receiver
            'senderId' => 'required|string',   // Sender
            'data' => 'required'
        ]);

        // Use $request->post() explicitly for multipart form data
        $receiverId = $request->post('userId');
        $senderId = $request->post('senderId');

        if ($request->hasFile('data')) {
            $file = $request->file('data');
            $content = file_get_contents($file->getRealPath());
        } else {
            $content = $request->post('data');
        }

        broadcast(new \App\Events\DataReceivedEvent($senderId, $receiverId, $content));

        return response()->json(['status' => 'data broadcasted', 'receiverId' => $receiverId]);
    });
});
