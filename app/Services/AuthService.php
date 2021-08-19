<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class AuthService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_auth.url');
        $this->http = Http::acceptJson();
    }

    public function auth(array $params = []): JsonResponse
    {
        $response = $this->http->post($this->url . '/auth', $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function getMe(array $headers): JsonResponse
    {
        $response = $this->http->withHeaders($headers)
                                ->get($this->url . '/me');

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function logout(array $headers): JsonResponse
    {
        $response = $this->http->withHeaders($headers)
            ->post($this->url . '/logout');

        return response()->json(json_decode($response->body()), $response->status());
    }
}
