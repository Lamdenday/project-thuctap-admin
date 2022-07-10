<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\OrderRepository;


class OrderService
{

    protected $OrderRepository;

    public function __construct(OrderRepository $OrderRepository)
    {
        $this->OrderRepository = $OrderRepository;
    }

    public function findOrFail($id)
    {
        return $this->OrderRepository->findOrFail($id);
    }

    public function search($request)
    {
        $dataSearch = $request->all();
        $dataSearch['CardName'] = $request->name ?? '';
        return $this->OrderRepository->search($dataSearch);
    }
    public function all(){
        return Order::all();
    }
}
