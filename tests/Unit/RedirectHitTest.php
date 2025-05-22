<?php

namespace Tests\Unit;

use App\Models\Redirect;
use App\Models\RedirectHit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectHitTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_instance_uses_server_values(): void
    {
        $_SERVER['REMOTE_ADDR'] = '192.168.1.1';
        $_SERVER['HTTP_USER_AGENT'] = 'UnitTestAgent/1.0';

        $redirect = Redirect::factory()->create();

        $hit = RedirectHit::makeInstance($redirect);

        $this->assertInstanceOf(RedirectHit::class, $hit);
        $this->assertSame('192.168.1.1', $hit->ip);
        $this->assertSame('UnitTestAgent/1.0', $hit->agent);
        $this->assertSame($redirect->id, $hit->redirect);
    }
}
