<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Получить список всех товаров
     */
    public function index()
    {
        $products = $this->productService->getProducts();
        return ProductResource::collection($products);
    }
}
