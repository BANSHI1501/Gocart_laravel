<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Apple',
                'category' => 'Fruits',
                'price' => 189,
                'offerPrice' => 129,
                'description' => ['Fresh red apples, perfect for snacking.'],
                'inStock' => true,
                'image' => ['https://images.unsplash.com/photo-1560806887-1e4cd0b6fac6?auto=format&fit=crop&w=400&q=80']
            ],
            [
                'name' => 'Baby corn',
                'category' => 'Vegetables',
                'price' => 49,
                'offerPrice' => 41,
                'description' => ['Fresh baby corn pack.'],
                'inStock' => true,
                'image' => ['https://images.unsplash.com/photo-1595856467362-e1c0c663f73c?auto=format&fit=crop&w=400&q=80']
            ],
            [
                'name' => 'Amul Taaza Toned Milk',
                'category' => 'Dairy',
                'price' => 20,
                'offerPrice' => 16,
                'description' => ['Healthy toned milk.'],
                'inStock' => true,
                'image' => ['https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=400&q=80']
            ],
            [
                'name' => 'Banana - 1 dozen',
                'category' => 'Fruits',
                'price' => 45,
                'offerPrice' => 40,
                'description' => ['Fresh yellow bananas.'],
                'inStock' => true,
                'image' => ['https://images.unsplash.com/photo-1571501679680-de32f1e7aad4?auto=format&fit=crop&w=400&q=80']
            ],
            [
                'name' => 'Brown Bread',
                'category' => 'Bakery',
                'price' => 25,
                'offerPrice' => 20,
                'description' => ['Freshly baked brown bread.'],
                'inStock' => true,
                'image' => ['https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=400&q=80']
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
