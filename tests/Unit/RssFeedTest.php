<?php

namespace Tests\Unit;

use App\Models\RssFeed;
use Tests\TestCase;

class RssFeedTest extends TestCase
{
    public function test_default_attributes()
    {
        $feed = new RssFeed();
        $this->assertEquals('New RSS Feed', $feed->name);
        $this->assertEquals('https://example.com/feed.xml', $feed->url);
    }
}
