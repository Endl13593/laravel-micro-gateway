<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ResourceService;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    protected $resourceService;

    public function __construct(ResourceService $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function index(Request $request)
    {
        return $this->resourceService->getResources([
            'Authorization' => $request->header('Authorization')
        ]);
    }
}
