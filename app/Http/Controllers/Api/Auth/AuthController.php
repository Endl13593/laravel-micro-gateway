<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function auth(Request $request): JsonResponse
    {
        return $this->authService->auth($request->all());
    }

    public function me(Request $request): JsonResponse
    {
        return $this->authService->getMe([
            'Authorization' => $request->header('Authorization')
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        return $this->authService->logout([
            'Authorization' => $request->header('Authorization')
        ]);
    }
}
