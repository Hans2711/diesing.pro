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
        $this->assertTrue(true);
    }

    /**
     * Test homepage contains search bar
     */
    public function test_homepage_contains_search_bar(): void
    {
        $response = $this->get('/de');
        
        $response->assertStatus(200);
        $response->assertSee('search-input', false); // Search input ID
        $response->assertSee('data-search-autocomplete', false); // Search autocomplete attribute
    }

    /**
     * Test English homepage contains search bar
     */
    public function test_english_homepage_contains_search_bar(): void
    {
        $response = $this->get('/en');
        
        $response->assertStatus(200);
        $response->assertSee('search-input', false);
        $response->assertSee('Search the web', false);
    }

    /**
     * Test German homepage contains search bar with German text
     */
    public function test_german_homepage_contains_search_bar_with_german_text(): void
    {
        $response = $this->get('/de');
        
        $response->assertStatus(200);
        $response->assertSee('Im Web suchen', false);
        $response->assertSee('Wikipedia', false); // From hint text
    }

    /**
     * Test homepage contains link to DuckDuckGo bangs page
     */
    public function test_homepage_contains_bangs_link(): void
    {
        $response = $this->get('/en');
        
        $response->assertStatus(200);
        $response->assertSee('https://duckduckgo.com/bangs', false);
        $response->assertSee('View all bangs', false);
    }

    /**
     * Test German homepage contains link to DuckDuckGo bangs page
     */
    public function test_german_homepage_contains_bangs_link(): void
    {
        $response = $this->get('/de');
        
        $response->assertStatus(200);
        $response->assertSee('https://duckduckgo.com/bangs', false);
        $response->assertSee('Alle Bangs ansehen', false);
    }

    /**
     * Test homepage contains Tester link in navigation
     */
    public function test_homepage_contains_tester_link(): void
    {
        $response = $this->get('/en');
        
        $response->assertStatus(200);
        $response->assertSee('https://tester.diesing.pro/', false);
        $response->assertSee('Tester', false);
    }

    /**
     * Test German homepage contains Tester link
     */
    public function test_german_homepage_contains_tester_link(): void
    {
        $response = $this->get('/de');
        
        $response->assertStatus(200);
        $response->assertSee('https://tester.diesing.pro/', false);
        $response->assertSee('Tester', false);
    }
}
