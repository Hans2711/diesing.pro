<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Utilities\LanguageUtility;

class LanguageUtilityTest extends TestCase
{
    public function test_de_contact_to_en()
    {
        App::setLocale('de');
        $request = Request::create('/de/kontakt');
        $this->app->instance('request', $request);

        $url = LanguageUtility::getOtherLangUrl();

        $this->assertEquals('/en/contact/', $url);
    }

    public function test_en_private_area_notes_to_de()
    {
        App::setLocale('en');
        $request = Request::create('/en/private-area/notes');
        $this->app->instance('request', $request);

        $url = LanguageUtility::getOtherLangUrl();

        $this->assertEquals('/de/privater-bereich/notizen/', $url);
    }
}
