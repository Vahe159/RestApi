<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Говяжий стейк',
                'description' => 'Мраморная говядина премиум',
                'price' => 1200,
                'category' => 'мясо',
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Свиной шашлык',
                'description' => 'Шея, маринад фирменный',
                'price' => 800,
                'category' => 'мясо',
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Куриное филе',
                'description' => 'Филе цыпленка охлажденное',
                'price' => 550,
                'category' => 'мясо',
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Колбаски гриль',
                'description' => 'Свинина, говядина, специи',
                'price' => 600,
                'category' => 'колбасы',
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
