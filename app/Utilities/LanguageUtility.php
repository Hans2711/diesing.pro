<?php
namespace App\Utilities;

use Illuminate\Support\Facades\App;

class LanguageUtility
{

    public static function getLangUrl(string $targetLocale)
    {
        $available = array_values(config('app.available_locales'));
        $currentUrl = request()->uri()->getUri()->getPath();

        $currentParts = explode('/', $currentUrl);
        foreach ($currentParts as $key => $part) {
            if (in_array($part, $available) || $part === '') {
                unset($currentParts[$key]);
            }
        }
        $currentParts = array_values($currentParts);
        $newUrl = '/' . $targetLocale . '/';

        $currentUrlTrans = __('url');
        $targetUrlTrans = __('url', [], $targetLocale);

        foreach ($currentParts as $part) {
            $keyMatch = null;
            foreach ($currentUrlTrans as $transkey => $value) {
                if ($part == $value) {
                    $keyMatch = $transkey;
                    break;
                }
            }

            if ($keyMatch !== null) {
                $newUrl .= $targetUrlTrans[$keyMatch] . '/';
            } else {
                $newUrl .= $part . '/';
            }
        }

        return $newUrl;
    }

    public static function getOtherLangUrl()
    {
        $current = App::getLocale();
        foreach (array_values(config('app.available_locales')) as $loc) {
            if ($loc !== $current) {
                return self::getLangUrl($loc);
            }
        }

        return '/' . $current . '/';
    }
}

