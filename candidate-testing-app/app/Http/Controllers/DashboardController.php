<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Display the dashboard along with the authors table.
     */
    public function index()
    {
        // Retrieve the access token stored during login.
        $accessToken = session('access_token');

        // API endpoint to fetch the list of authors.
        $apiUrl = 'https://candidate-testing.com/api/v2/authors';

        // Make the API call using Laravel's HTTP client.
        $response = Http::withToken($accessToken)
                        ->withHeaders(['Accept' => 'application/json'])
                        ->get($apiUrl);

        if ($response->successful()) {
            $result = $response->json();
            // Since your API response wraps the list in the "items" key:
            $authors = $result['items'] ?? [];
        } else {
            // If the API call fails, you may want to pass an empty array.
            $authors = [];
            // Optionally, you can also flash an error message.
            session()->flash('api_error', 'Unable to fetch authors.');
        }

        // Return the dashboard view with the authors data.
        return view('dashboard', compact('authors'));
    }
}
