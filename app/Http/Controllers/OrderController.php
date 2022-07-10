<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\CreateOrderRequest;
use App\Http\Requests\Orders\EditOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    protected $OrderService;

    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }

    public function index()
    {
        $Orders =$this->OrderService->all();
        return view('order.index', compact('Orders'));
    }

    public function list(Request $request)
    {
        $Orders = $this->OrderService->search($request);
        return view('orders.list', compact('Orders'))->render();
    }

}
