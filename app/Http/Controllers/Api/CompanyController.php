<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Utils\DefaultResponse;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        return $this->companyService->getAllCompanies($request->all());
    }

    public function store(Request $request)
    {
        return $this->companyService->newCompany($request->all());
    }

    public function show(string $identify): JsonResponse
    {
        return $this->companyService->getCompanyByIdentify($identify);
    }

    public function update(Request $request, string $identify): JsonResponse
    {
        return $this->companyService->updateCompany($identify, $request->all());
    }

    public function destroy(string $identify): JsonResponse
    {
        return $this->companyService->deleteCompany($identify);
    }
}
