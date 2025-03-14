<?php
namespace App\Utilities;

class IpGeoUtility
{
    public static function getGeo($ip) {
        $url = "http://ip-api.com/json/$ip";
        $response = file_get_contents($url);
        $data = json_decode($response);
        return $data;
    }

}

