<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SearchController extends Controller
{
    /**
     * Handle search requests with bang support
     *
     * Supports DuckDuckGo-style bangs (e.g., !g for Google, !w for Wikipedia)
     * Bangs can appear anywhere in the query but must be preceded by a space or be at the start
     * 
     * Examples:
     * - ?q=laravel tutorial -> Google search
     * - ?q=!g laravel -> Google search for "laravel"
     * - ?q=!w php -> Wikipedia search for "php"
     * - ?q=laravel !g tutorial -> Google search for "laravel tutorial"
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $query = $request->query('q', '');
        
        // Trim whitespace
        $query = trim($query);
        
        // If query is empty, redirect to Google
        if (empty($query)) {
            return $this->redirectToGoogle('', $request);
        }
        
        // Look for bang pattern: must be preceded by space or be at start
        // Pattern matches: !word or space!word (case insensitive)
        if (preg_match('/(^|\s)!([a-zA-Z0-9]+)(\s|$)/i', $query, $matches)) {
            $bangTrigger = strtolower($matches[2]); // Case insensitive
            
            // Remove the bang from the query
            $searchTerm = preg_replace('/(^|\s)!([a-zA-Z0-9]+)(\s|$)/i', '$1$3', $query);
            $searchTerm = trim($searchTerm);
            
            // Load bangs from JSON file
            $bangsPath = base_path('bangs.json');
            
            if (File::exists($bangsPath)) {
                $bangsJson = File::get($bangsPath);
                $bangs = json_decode($bangsJson, true);
                
                if ($bangs && is_array($bangs)) {
                    // Find matching bang (case insensitive)
                    foreach ($bangs as $bang) {
                        if (isset($bang['t']) && strtolower($bang['t']) === $bangTrigger) {
                            // Found a matching bang
                            $url = $bang['u'];
                            
                            // Replace {{{s}}} with the URL-encoded search term
                            $url = str_replace('{{{s}}}', urlencode($searchTerm), $url);
                            
                            return redirect($url);
                        }
                    }
                }
            }
            
            // Bang not found, fall through to Google search with full query
        }
        
        // Default: redirect to Google with the full query
        return $this->redirectToGoogle($query, $request);
    }
    
    /**
     * Redirect to Google search
     *
     * @param string $query
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectToGoogle(string $query, Request $request)
    {
        // Determine locale from URL path (first segment)
        $locale = $request->segment(1) ?? 'en';
        
        // Use google.de for German, google.com for English
        $googleDomain = $locale === 'de' ? 'https://www.google.de' : 'https://www.google.com';
        
        // Build Google search URL
        $url = $googleDomain . '/search?q=' . urlencode($query);
        
        return redirect($url);
    }
}
