<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function count()
    {
        return $this->model->count();
    }
    public function search($dataSearch)
    {
        return $this->model->searchWithName($dataSearch['CardName'])
            ->latest('id')->paginate(5);
    }
}
