<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    /**
     * Show the form to create a new book.
     */
    public function create()
    {
        $accessToken = session('access_token');

        // Fetch the list of authors to populate the dropdown
        $apiUrl = 'https://candidate-testing.com/api/v2/authors';
        $response = Http::withToken($accessToken)
                        ->withHeaders(['Accept' => 'application/json'])
                        ->get($apiUrl);

        $authors = [];
        if ($response->successful()) {
            $result = $response->json();
            // Your authors are in the "items" key
            $authors = $result['items'] ?? [];
        } else {
            session()->flash('api_error', 'Unable to fetch authors for the dropdown.');
        }

        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created book via the API.
     */
    public function store(Request $request)
    {
        $accessToken = session('access_token');

        // Minimal validation
        $request->validate([
            'author_id'       => 'required|integer',
            'title'           => 'required|string',
            'release_date'    => 'required|date',
            'description'     => 'nullable|string',
            'isbn'            => 'nullable|string',
            'format'          => 'nullable|string',
            'number_of_pages' => 'nullable|integer',
        ]);

        $apiUrl = 'https://candidate-testing.com/api/v2/books';

        // Prepare the payload according to the API spec
        $payload = [
            'author' => [
                'id' => $request->input('author_id'),
            ],
            'title'           => $request->input('title'),
            'release_date'    => $request->input('release_date'),
            'description'     => $request->input('description'),
            'isbn'            => $request->input('isbn'),
            'format'          => $request->input('format'),
            'number_of_pages' => (int) $request->input('number_of_pages'),
        ];

        $response = Http::withToken($accessToken)
                        ->withHeaders([
                            'Accept'       => 'application/json',
                            'Content-Type' => 'application/json',
                        ])
                        ->post($apiUrl, $payload);

        if ($response->successful()) {
            session()->flash('success', 'Book created successfully.');
            return redirect()->route('dashboard');
        } else {
            $error = $response->json()['message'] ?? 'Failed to create book.';
            return back()->withErrors(['api_error' => $error])->withInput();
        }
    }

    /**
     * Delete a single book via the API.
     */
    public function destroy($id)
    {
        $accessToken = session('access_token');

        $apiUrl = 'https://candidate-testing.com/api/v2/books/' . $id;
        $response = Http::withToken($accessToken)
                        ->withHeaders(['Accept' => 'application/json'])
                        ->delete($apiUrl);

        if ($response->status() == 204) {
            session()->flash('success', 'Book deleted successfully.');
        } else {
            $error = $response->json()['message'] ?? 'Failed to delete book.';
            session()->flash('api_error', $error);
        }

        // Redirect back to the previous page (typically the author details page)
        return redirect()->back();
    }
}
