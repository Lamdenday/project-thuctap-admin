<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\EditProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('products.index');
    }

    public function list(Request $request)
    {
        $products = $this->productService->search($request);
        return view('products.list', compact('products'))->render();
    }

    public function store(CreateProductRequest $request)
    {
        $data = $this->productService->create($request);

        return $this->sentSuccessResponse($data, 'Create product success', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $product = $this->productService->findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(EditProductRequest $request, $id)
    {
        $data = $this->productService->update($request, $id);
        return $this->sentSuccessResponse($data, 'Edit product success', Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return $this->sentSuccessResponse('', 'Delete product success', Response::HTTP_NO_CONTENT);
    }
}
