<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }

    public function search($dataSearch)
    {
        return $this->model->searchWithName($dataSearch['title'])
            ->latest('id')->paginate(5);
    }

    public function count()
    {
        return $this->model->count();
    }
}
