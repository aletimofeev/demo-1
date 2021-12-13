<?php

namespace App\Tests\Api;

use Symfony\Contracts\HttpClient\ResponseInterface;

trait ApiHelperTrait
{
    protected function requestWithToken(string $token, string $url, string $method = 'GET')
    {
        return static::createClient()
            ->request($method, $url, [
                'headers' => ['Content-Type' => 'application/json'],
                'auth_bearer' => $token,
            ]);

    }

    protected function requestAsUser(string $url, string $method = 'GET', array $data = null): ResponseInterface
    {
        $token = $this->getUserToken();

        $options = [
            'headers' => ['Content-Type' => 'application/json'],
            'auth_bearer' => $token,
        ];
        if ($data) {
            $options = array_merge($options, ['json' => $data]);
        }

        return static::createClient()
            ->request($method, $url, $options);
    }

    protected function requestAsEditor(string $url, string $method = 'GET'): ResponseInterface
    {
        $token = $this->getEditorToken();

        return static::createClient()
            ->request($method, $url, [
                'auth_bearer' => $token,
            ]);
    }

    protected function getUserToken(): string
    {
        return $this->getToken('user@example.com', 'user@example.com');
    }

    protected function getEditorToken(): string
    {
        return $this->getToken('editor@example.com', 'editor@example.com');
    }

    protected function getToken(string $email, string $password): string
    {
        $client = self::createClient();
        $response = $client->request('POST', '/api/login', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'email' => $email,
                'password' => $password,
            ],
        ]);

        list($token) = array_values($response->toArray());

        return $token;
    }
}
