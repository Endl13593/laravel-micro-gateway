<?php


namespace App\Services;


use App\Http\Utils\DefaultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class CompanyService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct()
    {
        $this->defaultResponse = new DefaultResponse();
        $this->url = config('microservices.available.micro_01.url') . '/companies';
        $this->http = Http::acceptJson();
    }

    public function getAllCompanies(array $params = [])
    {
        $response = $this->http->get($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function newCompany(array $params = [], UploadedFile $image = null)
    {
        if ($image)
            $this->http->attach('image', file_get_contents($image->getPathname()), $image->getClientOriginalName());

        $response = $this->http->post($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function getCompanyByIdentify(string $identify): JsonResponse
    {
        $response = $this->http->get("{$this->url}/{$identify}");

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function updateCompany(string $identify, array $params = [], UploadedFile $image = null): JsonResponse
    {
        if ($image)
            $this->http->attach('image', file_get_contents($image->getPathname()), $image->getClientOriginalName());

        $response = $this->http->put("{$this->url}/{$identify}", $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function deleteCompany(string $identify): JsonResponse
    {
        $response = $this->http->delete("{$this->url}/{$identify}");

        return response()->json(json_decode($response->body()), $response->status());
    }
}
