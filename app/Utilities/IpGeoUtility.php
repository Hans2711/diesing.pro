<?php
namespace App\Utilities;

use Illuminate\Support\Facades\Cache;

class IpGeoUtility
{
    public static function getGeo($ip)
    {
        return Cache::rememberForever("ip-geo-{$ip}", function () use ($ip) {
            $url = "http://ip-api.com/json/{$ip}";
            $response = file_get_contents($url);
            return json_decode($response);
        });
    }
}

