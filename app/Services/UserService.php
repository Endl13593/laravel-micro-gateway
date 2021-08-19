<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class UserService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_auth.url') . '/users';
        $this->http = Http::acceptJson()->withHeaders(['Authorization' => request()->header('Authorization')]);
    }

    public function getPermissionsUser(string $identify): JsonResponse
    {
        $response = $this->http->get($this->url . "/$identify/permissions");

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function addNewPermissionForUser(array $params = []): JsonResponse
    {
        $response = $this->http->post($this->url . '/permissions', $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function removePermissionForUser(array $params = []): JsonResponse
    {
        $response = $this->http->delete($this->url . '/permissions', $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function getAllUsers(array $params = [])
    {
        $response = $this->http->get($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function newUser(array $params = [])
    {
        $response = $this->http->post($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function getUserByIdentify(string $identify): JsonResponse
    {
        $response = $this->http->get("{$this->url}/{$identify}");

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function updateUser(string $identify, array $params = []): JsonResponse
    {
        $response = $this->http->put("{$this->url}/{$identify}", $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function deleteUser(string $identify): JsonResponse
    {
        $response = $this->http->delete("{$this->url}/{$identify}");

        return response()->json(json_decode($response->body()), $response->status());
    }
}
