<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class ApiAuthenticator
{
    protected string $loginUrl;

    public function __construct()
    {
        $this->loginUrl = config('app.api_login_url');
    }

    public function authenticate(Command $command): ?string
    {
        $email = $command->ask('Enter email (write: admin@example.com)');
        $password = $command->secret('Enter password (write: password)');

        $response = Http::post($this->loginUrl, [
            'email' => htmlspecialchars($email),
            'password' => htmlspecialchars($password),
        ]);

        if ($response->failed()) {
            $command->error('Login failed: ' . $response->json('message'));
            return null;
        }

        return $response->json('token');
    }
}
