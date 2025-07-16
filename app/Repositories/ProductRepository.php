<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * Получить все продукты
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $columns = ['id', 'name', 'description', 'price', 'category', 'available'])
    {
        return $this->model->all($columns);
    }
}
