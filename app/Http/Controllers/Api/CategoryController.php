<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        return $this->categoryService->getAllCategories($request->all());
    }

    public function store(Request $request)
    {
        return $this->categoryService->newCategory($request->all());
    }

    public function show(string $url): JsonResponse
    {
        return $this->categoryService->getCategoryByUrl($url);
    }

    public function update(Request $request, string $url): JsonResponse
    {
        return $this->categoryService->updateCategory($url, $request->all());
    }

    public function destroy(string $url): JsonResponse
    {
        return $this->categoryService->deleteCategory($url);
    }
}
