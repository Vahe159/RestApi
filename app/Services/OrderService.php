<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected OrderRepository $orderRepository;
    protected ProductRepository $productRepository;
    const MAX_ITEMS = 20;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Создать заказ
     * @throws \Exception
     */
    public function createOrder($userId, $items, $comment = null)
    {
        if (count($items) > self::MAX_ITEMS) {
            throw new \Exception('Максимум 20 товаров в заказе');
        }
        $total = 0;
        $orderItems = [];
        foreach ($items as $item) {
            $product = $this->productRepository->all()->find($item['product_id']);
            if (!$product || !$product->available) {
                throw new \Exception('Товар не найден или недоступен');
            }
            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ];
            $total += $product->price * $item['quantity'];
        }
        $orderData = [
            'user_id' => $userId,
            'total' => $total,
            'comment' => $comment,
            'status' => config('orders.default_status', 'new'),
        ];
        return $this->orderRepository->createWithItems($orderData, $orderItems);
    }

    public function getUserOrders($userId)
    {
        return $this->orderRepository->getByUser($userId);
    }
}
