<?php
namespace App\Utilities;

class FingerprintUtility
{
    public static function enableFingerprint($fingerprint)
    {
        $storePath = base_path() . "/fingerprints.json";
        $store = json_encode($storePath);

        if (empty($store) || !is_array($store)) {
            $store = [];
        }

        $store[self::getPublicIp()] = $fingerprint;
        file_put_contents($storePath, json_encode($store));
    }

    public static function checkFingerprint($fingerprint)
    {
        $storePath = base_path() . "/fingerprints.json";
        $store = json_decode(file_get_contents($storePath), true);

        if (empty($store) || !is_array($store)) {
            return false;
        }

        $ip = self::getPublicIp();
        if (empty($store[$ip])) {
            return false;
        }

        return $store[$ip] === $fingerprint;
    }

    private static function getPublicIp()
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        return $ip;
    }
}
