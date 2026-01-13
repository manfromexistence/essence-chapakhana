<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeder for creating consistent test data.
 *
 * This seeder creates a predictable set of data for testing purposes.
 */
class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users
        $adminUser = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'is_admin' => true,
        ]);

        $regularUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'is_admin' => false,
        ]);

        // Create test categories
        $categories = [
            Category::factory()->create(['name' => 'Books', 'slug' => 'books']),
            Category::factory()->create(['name' => 'Magazines', 'slug' => 'magazines']),
            Category::factory()->create(['name' => 'Brochures', 'slug' => 'brochures']),
            Category::factory()->create(['name' => 'Business Cards', 'slug' => 'business-cards']),
            Category::factory()->create(['name' => 'Stationery', 'slug' => 'stationery']),
        ];

        // Create test products for each category
        foreach ($categories as $category) {
            // Active products
            Product::factory()
                ->count(5)
                ->forCategory($category->id)
                ->active()
                ->inStock()
                ->create();

            // Some inactive products
            Product::factory()
                ->count(2)
                ->forCategory($category->id)
                ->inactive()
                ->create();

            // Some out of stock products
            Product::factory()
                ->count(1)
                ->forCategory($category->id)
                ->outOfStock()
                ->create();
        }

        // Create popular products
        Product::factory()
            ->count(5)
            ->popular()
            ->forCategory($categories[0]->id)
            ->create();

        // Create products on sale
        Product::factory()
            ->count(3)
            ->onSale()
            ->forCategory($categories[1]->id)
            ->create();

        // Create test orders for regular user
        $orders = Order::factory()
            ->count(3)
            ->forUser($regularUser->id)
            ->create();

        // Add items to each order
        foreach ($orders as $order) {
            $products = Product::inRandomOrder()->limit(rand(1, 3))->get();

            foreach ($products as $product) {
                OrderItem::factory()
                    ->forOrder($order->id)
                    ->forProduct($product)
                    ->withQuantity(rand(1, 3))
                    ->create();
            }

            // Update order totals
            $subtotal = $order->items->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            $tax = $subtotal * 0.1;
            $total = $subtotal + $tax;

            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
            ]);
        }

        // Create orders with different statuses
        Order::factory()->pending()->forUser($regularUser->id)->create();
        Order::factory()->processing()->forUser($regularUser->id)->create();
        Order::factory()->completed()->forUser($regularUser->id)->create();
        Order::factory()->cancelled()->forUser($regularUser->id)->create();

        // Create guest orders
        Order::factory()->count(2)->guest()->create();

        $this->command->info('Test data seeded successfully!');
        $this->command->info('Admin User: admin@test.com');
        $this->command->info('Regular User: user@test.com');
        $this->command->info('Password for both: password');
    }
}
