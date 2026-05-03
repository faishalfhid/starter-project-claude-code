<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryId = DB::table('categories')->insertGetId([
            'name' => 'Umum',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $products = [
            [
                'name' => 'Kemeja Polos Putih',
                'slug' => 'kemeja-polos-putih',
                'description' => 'Kemeja polos bahan katun premium, nyaman dipakai sehari-hari maupun formal.',
                'price' => 150000,
                'stock' => 50,
                'category_id' => $categoryId,
                'image_url' => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=600&q=80',
            ],
            [
                'name' => 'Celana Chino Slim',
                'slug' => 'celana-chino-slim',
                'description' => 'Celana chino slim fit tersedia dalam berbagai warna, bahan tidak mudah kusut.',
                'price' => 210000,
                'stock' => 35,
                'category_id' => $categoryId,
                'image_url' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=600&q=80',
            ],
            [
                'name' => 'Sepatu Sneakers Kasual',
                'slug' => 'sepatu-sneakers-kasual',
                'description' => 'Sneakers ringan dengan sol karet anti-slip, cocok untuk aktivitas harian.',
                'price' => 380000,
                'stock' => 20,
                'category_id' => $categoryId,
                'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80',
            ],
            [
                'name' => 'Tas Ransel Laptop',
                'slug' => 'tas-ransel-laptop',
                'description' => 'Ransel kapasitas 25L dengan kompartemen laptop 15 inch, bahan waterproof.',
                'price' => 275000,
                'stock' => 15,
                'category_id' => $categoryId,
                'image_url' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&q=80',
            ],
            [
                'name' => 'Kaos Oblong Basic',
                'slug' => 'kaos-oblong-basic',
                'description' => 'Kaos basic combed 30s, tersedia dalam 10 pilihan warna, adem dan menyerap keringat.',
                'price' => 85000,
                'stock' => 100,
                'category_id' => $categoryId,
                'image_url' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600&q=80',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
