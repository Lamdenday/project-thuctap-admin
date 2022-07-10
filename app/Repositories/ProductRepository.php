<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\HandleImage;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }

    public function search($dataSearch)
    {
        return $this->model->searchWithName($dataSearch['name'])->searchWithCategoryId($dataSearch['category_id'])
            ->searchWithMinPrice($dataSearch['min_price'])->searchWithMaxPrice($dataSearch['max_price'])
            ->latest('id')->paginate(5);
    }

    public function count()
    {
        return $this->model->count();
    }
}
