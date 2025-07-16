<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Получить список продуктов (SOLID: SRP)
     */
    public function getProducts()
    {
        return $this->productRepository->all();
    }
}
