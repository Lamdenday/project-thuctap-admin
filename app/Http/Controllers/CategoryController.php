<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\EditCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('categories.index');
    }

    public function list(Request $request)
    {
        $categoriesPaginate = $this->categoryService->search($request);
        return view('categories.list', compact('categoriesPaginate'))->render();
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $this->categoryService->create($request);
        return $this->sentSuccessResponse($data, 'Create category success', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $category = $this->categoryService->findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(EditCategoryRequest $request, $id)
    {
        $data = $this->categoryService->update($request, $id);
        return $this->sentSuccessResponse($data, 'Edit category success', Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return $this->sentSuccessResponse('', 'Delete category success', Response::HTTP_NO_CONTENT);
    }
}
