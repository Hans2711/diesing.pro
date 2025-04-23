<?php
namespace App\Utilities;

use Illuminate\Support\Facades\App;

class LanguageUtility
{

    public static function getOtherLangUrl()
    {
        $locale = App::getLocale();

        $otherLocale = '';
        if ($locale == 'de') {
            $otherLocale = 'en';
        } else {
            $otherLocale = 'de';
        }

        $currentUrl = request()->uri()->getUri()->getPath();

        $currentParts = explode('/', $currentUrl);
        foreach ($currentParts as $key => $part) {
            if ($part == 'de' || $part == 'en' || $part == '') {
                unset($currentParts[$key]);
            }
        }
        $currentParts = array_values($currentParts);
        $newUrl = '/' . $otherLocale . '/';

        $currentUrlTrans = __('url');
        $targetUrlTrans = __('url', [], $otherLocale);

        foreach ($currentParts as $key => $part) {
            $key = null;

            foreach ($currentUrlTrans as $transkey => $value) {
                if ($part == $value) {
                    $key = $transkey;
                    break;
                }
            }

            if ($key !== null) {
                $newUrl .= $targetUrlTrans[$key] . '/';
            } else {
                $newUrl .= $part . '/';
            }
        }

        return $newUrl;
    }
}

