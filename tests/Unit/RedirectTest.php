<?php

namespace Tests\Unit;

use App\Models\Redirect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_work_redirect_generates_unique_slug()
    {
        // First redirect should get slug based on name
        $first = Redirect::create([
            'name' => 'Test Redirect',
            'target' => 'https://example.com',
            'code' => 301,
        ]);
        $first->workRedirect();
        $first->save();
        $this->assertEquals('test-redirect', $first->slug);

        // Second redirect with same name should append id to slug
        $second = Redirect::create([
            'name' => 'Test Redirect',
            'target' => 'https://example.com/2',
            'code' => 302,
        ]);
        $second->workRedirect();
        $second->save();

        $expectedSlug = 'test-redirect-' . $second->id;
        $this->assertEquals($expectedSlug, $second->slug);
        $this->assertNotEquals($first->slug, $second->slug);
    }

    public function test_get_url_attribute_returns_expected_value()
    {
        $redirect = Redirect::create([
            'name' => 'Simple',
            'target' => 'https://example.com',
            'code' => 301,
        ]);
        $redirect->workRedirect();
        $redirect->save();

        $this->assertEquals(url('/r/' . $redirect->slug), $redirect->url);
    }
}
