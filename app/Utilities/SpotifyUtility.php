<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class SpotifyUtility
{
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->clientId = env("SPOTIFY_CLIENT_ID");
        $this->clientSecret = env("SPOTIFY_CLIENT_SECRET");
    }

    public function authenticate(): true
    {
        $cachedToken = Cache::get('spotify_access_token');
        if ($cachedToken) {
            return $cachedToken;
        }

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if (!$response->successful()) {
            return false;
        }

        $data = $response->json();
        $expiresAt = Carbon::now()->addSeconds($data['expires_in'])->timestamp;

        $tokenData = [
            'access_token' => $data['access_token'],
            'token_type' => $data['token_type'],
            'expires_in' => $data['expires_in'],
            'expires_at' => $expiresAt,
        ];

        Cache::put('spotify_access_token', $tokenData, $data['expires_in'] - 60);

        return true;
    }

    public function isAuthenticated(): bool
    {
        $tokenData = Cache::get('spotify_access_token');

        if (!$tokenData || !isset($tokenData['expires_at'])) {
            return false;
        }

        return Carbon::now()->timestamp < $tokenData['expires_at'];
    }

    public function getRecentlyPlayedTracks(): array|false
    {
        $tokenData = Cache::get('spotify_access_token');

        if (!$tokenData) {
            return false;
        }

        $response = Http::withToken($tokenData['access_token'])
            ->get('https://api.spotify.com/v1/me/player/recently-played', [
                'limit' => 10,
            ]);

        dd($response, $response->json());
        if (!$response->successful()) {
            return false;
        }

        $response = $response->json();
        Cache::put('spotify_recently_played', $response, 86400);

        return $response;
    }
}

