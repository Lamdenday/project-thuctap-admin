<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function search($request)
    {
        $dataSearch = $request->all();
        $dataSearch['title'] = $request->name ?? '';
        return $this->categoryRepository->search($dataSearch);
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function findOrFail($id)
    {
        return $this->categoryRepository->findOrFail($id);
    }

    public function create($request)
    {
        $dataCreate = $request->all();
        $category = New Category();

        $category['title'] = $dataCreate['name'];
        $category->save();

        return $category;
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->findOrFail($id);
        $category->delete();
        return true;
    }

    public function update($request, $id)
    {
        $data = $request->all();

        $category = $this->categoryRepository->findOrFail($id);

        $category['title'] = $data['name'];
        $category->save();
        return $category;
    }
}
