<?php


namespace App\Services;


use App\Http\Utils\DefaultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CategoryService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct()
    {
        $this->defaultResponse = new DefaultResponse();
        $this->url = config('microservices.available.micro_01.url') . '/categories';
        $this->http = Http::acceptJson();
    }

    public function getAllCategories(array $params = [])
    {
        $response = $this->http->get($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function newCategory(array $params = [])
    {
        $response = $this->http->post($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function getCategoryByUrl(string $url): JsonResponse
    {
        $response = $this->http->get("{$this->url}/{$url}");

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function updateCategory(string $url, array $params = []): JsonResponse
    {
        $response = $this->http->put("{$this->url}/{$url}", $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function deleteCategory(string $url): JsonResponse
    {
        $response = $this->http->delete("{$this->url}/{$url}");

        return response()->json(json_decode($response->body()), $response->status());
    }
}
