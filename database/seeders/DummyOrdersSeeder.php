<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->warn('Please seed users and products first!');
            return;
        }

        // Generate orders for the last 90 days
        for ($i = 90; $i >= 0; $i--) {
            $date = now()->subDays($i);
            
            // Random number of orders per day (0-5)
            $ordersCount = rand(0, 5);
            
            for ($j = 0; $j < $ordersCount; $j++) {
                $user = $users->random();
                
                // Create order
                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => 'ORD-' . strtoupper(uniqid()),
                    'shipping_name' => $user->name,
                    'shipping_email' => $user->email,
                    'shipping_phone' => '01' . rand(700000000, 999999999),
                    'shipping_address' => fake()->address(),
                    'shipping_city' => fake()->city(),
                    'shipping_state' => fake()->state(),
                    'shipping_zip' => fake()->postcode(),
                    'shipping_country' => 'Bangladesh',
                    'payment_method' => fake()->randomElement(['cash_on_delivery', 'bank_transfer', 'mobile_banking']),
                    'subtotal' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'status' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled']),
                    'notes' => fake()->optional()->sentence(),
                    'created_at' => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                    'updated_at' => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                ]);

                // Add 1-4 items to the order
                $itemsCount = rand(1, 4);
                $subtotal = 0;

                for ($k = 0; $k < $itemsCount; $k++) {
                    $product = $products->random();
                    $quantity = rand(1, 5);
                    $price = $product->price;
                    $itemTotal = $price * $quantity;
                    $subtotal += $itemTotal;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_title' => $product->title,
                        'product_image' => $product->image,
                        'format' => null,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);
                }

                // Update order totals
                $tax = $subtotal * 0.05; // 5% tax
                $total = $subtotal + $tax;

                $order->update([
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                ]);
            }
        }

        $this->command->info('Dummy orders created successfully!');
    }
}
