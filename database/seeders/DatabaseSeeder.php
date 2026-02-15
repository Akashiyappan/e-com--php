<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);

        // Create regular test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => false,
        ]);

        // Create sample products
        $products = [
            [
                'name' => 'Wireless Headphones',
                'description' => 'High-quality wireless headphones with noise cancellation and 30-hour battery life.',
                'price' => 79.99,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop',
                'category' => 'Electronics',
                'quantity' => 50
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Feature-packed smartwatch with fitness tracking, heart rate monitor, and GPS.',
                'price' => 199.99,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&h=500&fit=crop',
                'category' => 'Electronics',
                'quantity' => 40
            ],
            [
                'name' => 'Running Shoes',
                'description' => 'Comfortable running shoes with excellent cushioning and support.',
                'price' => 89.99,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&h=500&fit=crop',
                'category' => 'Footwear',
                'quantity' => 35
            ],
            [
                'name' => 'Backpack',
                'description' => 'Durable backpack with multiple compartments and laptop sleeve.',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500&h=500&fit=crop',
                'category' => 'Accessories',
                'quantity' => 60
            ],
            [
                'name' => 'Coffee Maker',
                'description' => 'Premium coffee maker with programmable settings and thermal carafe.',
                'price' => 129.99,
                'image' => 'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=500&h=500&fit=crop',
                'category' => 'Home',
                'quantity' => 25
            ],
            [
                'name' => 'Yoga Mat',
                'description' => 'Non-slip yoga mat with extra thickness for comfort and support.',
                'price' => 29.99,
                'image' => 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?w=500&h=500&fit=crop',
                'category' => 'Fitness',
                'quantity' => 45
            ],
            [
                'name' => 'Desk Lamp',
                'description' => 'LED desk lamp with adjustable brightness and color temperature.',
                'price' => 39.99,
                'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=500&h=500&fit=crop',
                'category' => 'Home',
                'quantity' => 55
            ],
            [
                'name' => 'Sunglasses',
                'description' => 'Stylish sunglasses with UV protection and polarized lenses.',
                'price' => 59.99,
                'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop',
                'category' => 'Accessories',
                'quantity' => 70
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
