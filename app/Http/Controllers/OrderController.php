<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderListRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Оформить заказ
     */
    public function store(OrderStoreRequest $request)
    {
        try {
            $order = $this->orderService->createOrder(
                $request->user_id,
                $request->items,
                $request->comment
            );
            $order->load('items.product');
            return new OrderResource($order);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * История заказов пользователя
     */
    public function index(OrderListRequest $request)
    {
        $orders = $this->orderService->getUserOrders($request->user_id);
        return OrderResource::collection($orders);
    }
}
