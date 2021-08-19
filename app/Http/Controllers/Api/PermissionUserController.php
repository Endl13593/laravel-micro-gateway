<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getPermissionsUser($identify): JsonResponse
    {
        return $this->userService->getPermissionsUser($identify);
    }

    public function addPermissionUser(Request $request): JsonResponse
    {
        return $this->userService->addNewPermissionForUser($request->all());
    }

    public function removePermissionUser(Request $request): JsonResponse
    {
        return $this->userService->removePermissionForUser($request->all());
    }
}
