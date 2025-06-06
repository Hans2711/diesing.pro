<?php

namespace Tests\Unit;

use App\Mail\RssFeedNotification;
use Tests\TestCase;

class RssFeedNotificationTest extends TestCase
{
    public function test_subject_includes_feed_name()
    {
        $mail = new RssFeedNotification('http://example.com', 'Title', '', '', '', 'en', 'My Feed');
        $this->assertEquals('New RSS Feed Item - My Feed', $mail->envelope()->subject);
    }
}
