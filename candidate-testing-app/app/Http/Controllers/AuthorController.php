<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthorController extends Controller
{
    /**
     * Display a listing of authors.
     */
    public function index()
    {
        $accessToken = session('access_token');
        $apiUrl = 'https://candidate-testing.com/api/v2/authors';
    
        $response = Http::withToken($accessToken)
                        ->withHeaders(['Accept' => 'application/json'])
                        ->get($apiUrl);
    
        if ($response->successful()) {
            $result = $response->json();
    
            // The API returns the authors list in the "items" key.
            $authors = $result['items'] ?? [];
    
            return view('authors.index', compact('authors'));
        } else {
            return back()->withErrors(['api_error' => 'Unable to fetch authors.']);
        }
    }

    /**
     * Display the specified author and their books.
     */
    public function show($id)
    {
        $accessToken = session('access_token');

        // API endpoint to get a single author (with their books)
        $apiUrl = 'https://candidate-testing.com/api/v2/authors/' . $id;

        $response = Http::withToken($accessToken)
                        ->withHeaders(['Accept' => 'application/json'])
                        ->get($apiUrl);

        if ($response->successful()) {
            $author = $response->json();
            return view('authors.show', compact('author'));
        } else {
            return back()->withErrors(['api_error' => 'Unable to fetch author details.']);
        }
    }

    /**
     * Remove the specified author.
     */
    public function destroy($id)
    {
        $accessToken = session('access_token');

        // Before deletion, fetch the author details to check if there are any books.
        $detailUrl = 'https://candidate-testing.com/api/v2/authors/' . $id;
        $detailResponse = Http::withToken($accessToken)
                              ->withHeaders(['Accept' => 'application/json'])
                              ->get($detailUrl);

        if (!$detailResponse->successful()) {
            return back()->withErrors(['api_error' => 'Unable to fetch author details for deletion.']);
        }

        $author = $detailResponse->json();

        // Check if the author has any books
        if (isset($author['books']) && count($author['books']) > 0) {
            return back()->withErrors(['api_error' => 'Cannot delete author with related books.']);
        }

        // Proceed to delete the author using the DELETE endpoint.
        $deleteUrl = 'https://candidate-testing.com/api/v2/authors/' . $id;
        $deleteResponse = Http::withToken($accessToken)
                              ->withHeaders(['Accept' => 'application/json'])
                              ->delete($deleteUrl);

        if ($deleteResponse->status() == 204) {
            return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
        } else {
            $error = $deleteResponse->json()['message'] ?? 'Deletion failed.';
            return back()->withErrors(['api_error' => $error]);
        }
    }
}
