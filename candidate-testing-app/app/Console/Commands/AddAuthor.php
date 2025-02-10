<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AddAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'author:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new author via the API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Prompt the user for author details
        $firstName    = $this->ask('Enter first name');
        $lastName     = $this->ask('Enter last name');
        $birthday     = $this->ask('Enter birthday (YYYY-MM-DD)');
        $biography    = $this->ask('Enter biography');
        $gender       = $this->choice('Select gender', ['male', 'female'], 0);
        $placeOfBirth = $this->ask('Enter place of birth');

        // Retrieve the API token from the environment, or prompt the user if not set.
        // You can add your token to your .env file as API_TOKEN=your_token.
        $token = env('API_TOKEN') ?: $this->ask('Enter your API token');

        // Prepare the payload for the API
        $payload = [
            'first_name'     => $firstName,
            'last_name'      => $lastName,
            'birthday'       => $birthday,
            'biography'      => $biography,
            'gender'         => $gender,
            'place_of_birth' => $placeOfBirth,
        ];

        // API endpoint for creating a new author
        $apiUrl = 'https://candidate-testing.com/api/v2/authors';

        // Send a POST request to the API with the payload
        $response = Http::withToken($token)
            ->withHeaders([
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->post($apiUrl, $payload);

        // Handle the API response
        if ($response->successful()) {
            $author = $response->json();
            $this->info('Author created successfully with ID: ' . $author['id']);
        } else {
            $this->error('Failed to create author. Error: ' . $response->body());
        }
    }
}
