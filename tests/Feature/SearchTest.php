<?php

namespace Tests\Feature;

use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * Test search route redirects to Google when no query provided (English)
     */
    public function test_search_redirects_to_google_when_no_query_provided_english(): void
    {
        $response = $this->get('/en/search');
        
        $response->assertRedirect();
        $this->assertTrue(
            str_starts_with($response->headers->get('Location'), 'https://www.google.com/search')
        );
    }

    /**
     * Test search route redirects to Google.de when no query provided (German)
     */
    public function test_search_redirects_to_google_de_when_no_query_provided_german(): void
    {
        $response = $this->get('/de/suche');
        
        $response->assertRedirect();
        $this->assertTrue(
            str_starts_with($response->headers->get('Location'), 'https://www.google.de/search')
        );
    }

    /**
     * Test search redirects to Google with query (English)
     */
    public function test_search_redirects_to_google_with_query_english(): void
    {
        $response = $this->get('/en/search?q=laravel+tutorial');
        
        $response->assertRedirect('https://www.google.com/search?q=laravel+tutorial');
    }

    /**
     * Test search redirects to Google.de with query (German)
     */
    public function test_search_redirects_to_google_with_query_german(): void
    {
        $response = $this->get('/de/suche?q=laravel+tutorial');
        
        $response->assertRedirect('https://www.google.de/search?q=laravel+tutorial');
    }

    /**
     * Test bang at start of query
     */
    public function test_bang_at_start_of_query(): void
    {
        // Using !g bang (Google)
        $response = $this->get('/en/search?q=!g+laravel');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should redirect to Google (the !g bang)
        $this->assertTrue(str_contains($location, 'google'));
    }

    /**
     * Test bang in middle of query
     */
    public function test_bang_in_middle_of_query(): void
    {
        // Bang with space before it: "laravel !w tutorial"
        $response = $this->get('/en/search?q=laravel+!w+tutorial');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should redirect to Wikipedia (the !w bang)
        $this->assertTrue(str_contains($location, 'wikipedia'));
    }

    /**
     * Test bang at end of query
     */
    public function test_bang_at_end_of_query(): void
    {
        // Bang at end: "laravel !w"
        $response = $this->get('/en/search?q=laravel+!w');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should redirect to Wikipedia
        $this->assertTrue(str_contains($location, 'wikipedia'));
    }

    /**
     * Test case insensitive bang
     */
    public function test_bang_is_case_insensitive(): void
    {
        // Test uppercase bang
        $response1 = $this->get('/en/search?q=!W+php');
        $response1->assertRedirect();
        $location1 = $response1->headers->get('Location');
        
        // Test lowercase bang
        $response2 = $this->get('/en/search?q=!w+php');
        $response2->assertRedirect();
        $location2 = $response2->headers->get('Location');
        
        // Both should go to Wikipedia
        $this->assertTrue(str_contains($location1, 'wikipedia'));
        $this->assertTrue(str_contains($location2, 'wikipedia'));
    }

    /**
     * Test invalid bang falls back to Google
     */
    public function test_invalid_bang_falls_back_to_google(): void
    {
        // Using non-existent bang
        $response = $this->get('/en/search?q=!xyz123notreal+test');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should fall back to Google with the full query including the bang
        $this->assertTrue(str_starts_with($location, 'https://www.google.com/search'));
        $this->assertTrue(str_contains($location, 'xyz123notreal'));
    }

    /**
     * Test bang without space before it (should not trigger)
     */
    public function test_bang_without_space_does_not_trigger(): void
    {
        // email!w should not trigger bang (no space before !)
        $response = $this->get('/en/search?q=email!w+address');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should go to Google, not Wikipedia
        $this->assertTrue(str_starts_with($location, 'https://www.google.com/search'));
        $this->assertTrue(str_contains($location, 'email'));
    }

    /**
     * Test URL encoding in search term
     */
    public function test_url_encoding_in_search_term(): void
    {
        $response = $this->get('/en/search?q=hello+world+%26+special+chars');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should properly encode the search term
        $this->assertTrue(str_contains($location, 'google.com'));
    }

    /**
     * Test YouTube bang (!yt)
     */
    public function test_youtube_bang(): void
    {
        $response = $this->get('/en/search?q=!yt+music+video');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should redirect to YouTube
        $this->assertTrue(
            str_contains($location, 'youtube') || str_contains($location, 'youtu.be')
        );
    }

    /**
     * Test German route uses correct URL slug
     */
    public function test_german_route_uses_suche_slug(): void
    {
        // Test that /de/suche works
        $response = $this->get('/de/suche?q=test');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should redirect to google.de
        $this->assertTrue(str_contains($location, 'google.de'));
    }

    /**
     * Test English route uses correct URL slug
     */
    public function test_english_route_uses_search_slug(): void
    {
        // Test that /en/search works
        $response = $this->get('/en/search?q=test');
        
        $response->assertRedirect();
        $location = $response->headers->get('Location');
        
        // Should redirect to google.com
        $this->assertTrue(str_contains($location, 'google.com'));
    }
}
