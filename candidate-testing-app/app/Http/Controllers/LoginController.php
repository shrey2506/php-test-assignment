<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Process the login request.
     */
    public function login(Request $request)
    {
        // Validate the request data (minimal validation)
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Use the correct API endpoint from the project description
        $apiUrl = 'https://candidate-testing.com/api/v2/token';

        // Prepare the payload with credentials from the form
        $payload = [
            'email'    => $request->input('email'),
            'password' => $request->input('password')
        ];

        // Send POST request to the Candidate Testing API with required headers
        $response = Http::withHeaders([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($apiUrl, $payload);

        // Debugging tip: Uncomment the next line to log the raw response for troubleshooting
        // \Log::info('API Response', [$response->body()]);

        // Check if the API call was successful
        if ($response->successful()) {
            $data = $response->json();

            // Check if we received the token_key from the API
            if (isset($data['token_key'])) {
                // Store the tokens and user details in session
                session([
                    'access_token'  => $data['token_key'],
                    'refresh_token' => $data['refresh_token_key'],
                    'user'          => $data['user'] ?? null,
                ]);

                // Redirect to the dashboard page after successful login
                return redirect()->route('dashboard');
            } else {
                // If the token is missing, show an error message
                return back()->withErrors(['login_error' => 'Access token not found in response.']);
            }
        } else {
            // If the API call failed, get the error message if available
            $error = $response->json()['message'] ?? 'Login failed. Please try again.';
            return back()->withErrors(['login_error' => $error]);
        }
    }
}
