<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\AbstractRepository;

class OrderRepository extends AbstractRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function createWithItems(array $data, array $items)
    {
        $order = $this->model->create($data);
        foreach ($items as $item) {
            $order->items()->create($item);
        }
        return $order;

    }

    public function getByUser($userId)
    {
        return $this->model->with('items.product')->where('user_id', $userId)->get();
    }
}
