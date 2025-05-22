<?php

namespace App\Utilities;

class MinifyHtml
{
    protected static bool $enabled = true;

    public static function enable(): void
    {
        static::$enabled = true;
    }

    public static function disable(): void
    {
        static::$enabled = false;
    }

    public static function isEnabled(): bool
    {
        return static::$enabled;
    }
}
