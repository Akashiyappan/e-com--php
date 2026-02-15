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
                'name' => 'Premium Shoes',
                'description' => 'Comfortable and stylish premium shoes',
                'price' => 89.99,
                'image' => 'https://picsum.photos/250/200?1',
                'quantity' => 50
            ],
            [
                'name' => 'Luxury Watch',
                'description' => 'Elegant luxury watch for everyday wear',
                'price' => 199.99,
                'image' => 'https://picsum.photos/250/200?2',
                'quantity' => 30
            ],
            [
                'name' => 'Designer Bag',
                'description' => 'Premium designer bag made with finest materials',
                'price' => 149.99,
                'image' => 'https://picsum.photos/250/200?3',
                'quantity' => 25
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'High-quality wireless headphones with noise cancellation',
                'price' => 129.99,
                'image' => 'https://picsum.photos/250/200?4',
                'quantity' => 40
            ],
            [
                'name' => 'Sunglasses',
                'description' => 'Trendy sunglasses with UV protection',
                'price' => 79.99,
                'image' => 'https://picsum.photos/250/200?5',
                'quantity' => 60
            ],
            [
                'name' => 'Leather Belt',
                'description' => 'Genuine leather belt with premium buckle',
                'price' => 49.99,
                'image' => 'https://picsum.photos/250/200?6',
                'quantity' => 80
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
