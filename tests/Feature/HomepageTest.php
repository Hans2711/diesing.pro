<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/en');
        $response->assertStatus(200);

        $response = $this->get('/de');
        $response->assertStatus(200);

        $response = $this->get('/fr');
        $response->assertStatus(200);

        $response = $this->get('/es');
        $response->assertStatus(200);
    }
}
