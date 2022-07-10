<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Traits\HandleImage;

class ProductService
{
    use HandleImage;

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function search($request)
    {
        $dataSearch = $request->all();
        $dataSearch['name'] = $request->name ?? '';
        $dataSearch['category_id'] = $request->category_id ?? '';
        $dataSearch['min_price'] = $request->min_price ?? '';
        $dataSearch['max_price'] = $request->max_price ?? '';
        return $this->productRepository->search($dataSearch);
    }

    public function create($request)
    {
        $dataCreate = $request->all();
        $dataCreate['image'] = $this->saveImage($request);
        $product = New Product;

        $product->title = $dataCreate['title'];
        $product->description = $dataCreate['description'];
        $product->price = $dataCreate['price'];
        $product->category_id = $dataCreate['category_id'];
        $product->image_url = $dataCreate['image'];

        $product->save();
        return $product;
    }

    public function findOrFail($id)
    {
        return $this->productRepository->findOrFail($id);
    }

    public function update($request, $id)
    {

        $product = $this->productRepository->find($id);
        $dataUpdate = $request->all();
        $dataUpdate['image'] = $this->updateImage($request, $product->image);

        $product->title = $dataUpdate['title'];
        $product->description = $dataUpdate['description'];
        $product->price = $dataUpdate['price'];
        $product->category_id = $dataUpdate['category_id'];
        $product->image_url = $dataUpdate['image'];

        $product->save();
        return $product;
    }

    public function delete($id)
    {
        $product = $this->productRepository->find($id);
        if($product->image_url !='' || $product->image_url != null)
            $this->deleteImage($product->image_url);
        $product->delete();
        return true;
    }
}
