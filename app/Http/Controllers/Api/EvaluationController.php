<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EvaluationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(Request $request, string $identify): JsonResponse
    {
        return $this->evaluationService->createNewEvaluationByCompany($identify, $request->all());
    }
}
