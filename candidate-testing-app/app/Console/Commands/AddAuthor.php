<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-author';

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
        $firstName = $this->ask('First Name');
        $lastName = $this->ask('Last Name');
        $birthday = $this->ask('Birthday (YYYY-MM-DD)');
        $biography = $this->ask('Biography');
        $gender = $this->choice('Gender', ['male', 'female'], 0);
        $placeOfBirth = $this->ask('Place of Birth');

        // API endpoint for creating a new author.
        $apiUrl = 'https://candidate-testing.com/api/v2/authors';

        // Prepare the payload.
        $payload = [
            'first_name'     => $firstName,
            'last_name'      => $lastName,
            'birthday'       => $birthday,
            'biography'      => $biography,
            'gender'         => $gender,
            'place_of_birth' => $placeOfBirth,
        ];

        $response = Http::withHeaders([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($apiUrl, $payload);

        if ($response->successful()) {
            $author = $response->json();
            $this->info('Author created successfully. ID: ' . $author['id']);
        } else {
            $error = $response->json()['message'] ?? 'Error creating author';
            $this->error('Failed to create author: ' . $error);
        }
    }
}
