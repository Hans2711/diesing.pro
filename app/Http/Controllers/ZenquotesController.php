<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ZenquotesController extends Controller
{
    public function random() {
        try {
            $response = Http::get('https://zenquotes.io/api/random');

            if ($response->successful()) {
                $quoteData = $response->json()[0];

                return response()->json([
                    'quote' => $quoteData['q'],
                    'author' => $quoteData['a'],
                ]);
            }

            return response()->json([
                'error' => 'Could not fetch quote',
                'response' => $response->body()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching quote: ' . $e->getMessage()
            ], 500);
        }
    }
}
