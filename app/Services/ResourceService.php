<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ResourceService
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

    public function getResources(array $headers)
    {
        $response = $this->http->withHeaders($headers)
                                ->get($this->url . '/resources');

        return $this->defaultResponse->response($response);
    }
}
