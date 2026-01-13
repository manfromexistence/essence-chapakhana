<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->words(3, true);
        $basePrice = $this->faker->randomFloat(2, 10, 500);

        return [
            'category_id' => Category::factory(),
            'title' => ucwords($title),
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(),
            'format' => $this->faker->randomElement(['A4', 'A5', 'Letter', 'Custom']),
            'price' => $basePrice * 1.2, // 20% markup
            'base_price' => $basePrice,
            'min_quantity' => $this->faker->randomElement([1, 10, 50, 100]),
            'min_pages' => $this->faker->numberBetween(1, 10),
            'max_pages' => $this->faker->numberBetween(100, 500),
            'rating' => $this->faker->randomFloat(1, 3.0, 5.0),
            'popularity' => $this->faker->numberBetween(0, 1000),
            'stock' => true,
            'badge' => $this->faker->optional(0.3)->randomElement(['New', 'Sale', 'Popular', 'Limited']),
            'config_options' => null,
            'image' => '/storage/products/placeholder.jpg',
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the product is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the product is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the product is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => false,
        ]);
    }

    /**
     * Indicate that the product is in stock.
     */
    public function inStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => true,
        ]);
    }

    /**
     * Create a product with a specific price.
     */
    public function withPrice(float $price): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => $price,
            'base_price' => $price * 0.8,
        ]);
    }

    /**
     * Create a product with a specific category.
     */
    public function forCategory(int $categoryId): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => $categoryId,
        ]);
    }

    /**
     * Create a popular product.
     */
    public function popular(): static
    {
        return $this->state(fn (array $attributes) => [
            'popularity' => $this->faker->numberBetween(500, 1000),
            'rating' => $this->faker->randomFloat(1, 4.0, 5.0),
            'badge' => 'Popular',
        ]);
    }

    /**
     * Create a product on sale.
     */
    public function onSale(): static
    {
        return $this->state(function (array $attributes) {
            $basePrice = $attributes['base_price'] ?? 100;

            return [
                'price' => $basePrice * 0.7, // 30% discount
                'badge' => 'Sale',
            ];
        });
    }

    /**
     * Create a product with config options.
     */
    public function withConfigOptions(): static
    {
        return $this->state(fn (array $attributes) => [
            'config_options' => [
                'colors' => ['Red', 'Blue', 'Green'],
                'sizes' => ['Small', 'Medium', 'Large'],
                'finishes' => ['Matte', 'Glossy'],
            ],
        ]);
    }
}
