<?php

namespace Database\Seeders;

use App\Models\ServiceConfigOption;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class ServiceConfigOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding service product configuration options...');

        // Get all service products
        $products = ServiceProduct::all();

        foreach ($products as $product) {
            // Delete existing config options for this product
            ServiceConfigOption::where('service_product_id', $product->id)->delete();

            // Add common config options based on category
            $categorySlug = $product->category->slug ?? '';

            $this->addCommonOptions($product);

            // Add category-specific options
            switch ($categorySlug) {
                case 'magazines':
                case 'catalogs':
                case 'books':
                case 'booklets':
                    $this->addPublicationOptions($product);
                    break;
                case 'business-cards':
                    $this->addBusinessCardOptions($product);
                    break;
                case 'banners':
                case 'signage':
                    $this->addBannerOptions($product);
                    break;
                case 'stickers':
                    $this->addStickerOptions($product);
                    break;
                case 'brochures':
                case 'marketing':
                    $this->addBrochureOptions($product);
                    break;
                case 'stationery':
                case 'postcards-invitations':
                    $this->addStationeryOptions($product);
                    break;
                default:
                    $this->addGenericOptions($product);
            }
        }

        $this->command->info('Service configuration options seeded successfully!');
    }

    private function addCommonOptions($product)
    {
        // Quantity option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Quantity',
            'option_type' => 'button',
            'option_values' => ['50', '100', '250', '500', '1000'],
            'option_prices' => [0, 10, 25, 50, 90],
            'default_value' => '100',
            'display_order' => 1,
            'is_required' => true,
        ]);
    }

    private function addPublicationOptions($product)
    {
        // Size option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Size',
            'option_type' => 'button',
            'option_values' => ['A5 (148×210mm)', 'A4 (210×297mm)', 'Letter (8.5×11")', 'Custom Size'],
            'option_prices' => [0, 5, 5, 10],
            'default_value' => 'A4 (210×297mm)',
            'display_order' => 2,
            'is_required' => true,
        ]);

        // Pages option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Number of Pages',
            'option_type' => 'button',
            'option_values' => ['8 Pages', '16 Pages', '24 Pages', '32 Pages', '48 Pages', '64 Pages'],
            'option_prices' => [0, 5, 10, 15, 25, 35],
            'default_value' => '16 Pages',
            'display_order' => 3,
            'is_required' => true,
        ]);

        // Paper type
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Paper Type',
            'option_type' => 'tabs',
            'option_values' => ['80gsm Offset', '100gsm Gloss', '130gsm Gloss', '170gsm Silk'],
            'option_prices' => [0, 3, 6, 10],
            'default_value' => '100gsm Gloss',
            'display_order' => 4,
            'is_required' => true,
        ]);

        // Cover finish
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Cover Finish',
            'option_type' => 'tabs',
            'option_values' => ['Gloss Lamination', 'Matte Lamination', 'Soft Touch', 'No Lamination'],
            'option_prices' => [5, 5, 10, 0],
            'default_value' => 'Gloss Lamination',
            'display_order' => 5,
            'is_required' => false,
        ]);

        // Binding
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Binding Type',
            'option_type' => 'radio',
            'option_values' => ['Saddle Stitch', 'Perfect Binding', 'Wire-O Binding', 'Spiral Binding'],
            'option_prices' => [0, 8, 10, 8],
            'default_value' => 'Saddle Stitch',
            'display_order' => 6,
            'is_required' => true,
        ]);
    }

    private function addBusinessCardOptions($product)
    {
        // Size option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Card Size',
            'option_type' => 'button',
            'option_values' => ['Standard (3.5×2")', 'Square (2.5×2.5")', 'Mini (3×1")', 'European (3.346×2.165")'],
            'option_prices' => [0, 2, 0, 2],
            'default_value' => 'Standard (3.5×2")',
            'display_order' => 2,
            'is_required' => true,
        ]);

        // Paper stock
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Paper Stock',
            'option_type' => 'tabs',
            'option_values' => ['300gsm Gloss', '350gsm Matte', '400gsm Premium', '450gsm Ultra Thick'],
            'option_prices' => [0, 2, 5, 8],
            'default_value' => '300gsm Gloss',
            'display_order' => 3,
            'is_required' => true,
        ]);

        // Finish
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Finish',
            'option_type' => 'button',
            'option_values' => ['Gloss', 'Matte', 'Soft Touch', 'Spot UV', 'Foil Stamping'],
            'option_prices' => [0, 0, 5, 8, 15],
            'default_value' => 'Gloss',
            'display_order' => 4,
            'is_required' => true,
        ]);

        // Corners
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Corners',
            'option_type' => 'tabs',
            'option_values' => ['Square', 'Rounded'],
            'option_prices' => [0, 3],
            'default_value' => 'Square',
            'display_order' => 5,
            'is_required' => false,
        ]);

        // Printing sides
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Printed Sides',
            'option_type' => 'radio',
            'option_values' => ['Single Side', 'Double Side'],
            'option_prices' => [0, 5],
            'default_value' => 'Double Side',
            'display_order' => 6,
            'is_required' => true,
        ]);
    }

    private function addBannerOptions($product)
    {
        // Size option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Banner Size',
            'option_type' => 'button',
            'option_values' => ['2×3 ft', '3×4 ft', '4×6 ft', '5×8 ft', 'Custom Size'],
            'option_prices' => [0, 15, 30, 50, 0],
            'default_value' => '3×4 ft',
            'display_order' => 2,
            'is_required' => true,
        ]);

        // Material
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Material',
            'option_type' => 'tabs',
            'option_values' => ['Vinyl', 'Mesh', 'Fabric', 'Canvas'],
            'option_prices' => [0, 5, 15, 20],
            'default_value' => 'Vinyl',
            'display_order' => 3,
            'is_required' => true,
        ]);

        // Finishing
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Finishing',
            'option_type' => 'button',
            'option_values' => ['Grommets', 'Pole Pockets', 'Hemmed Edges', 'None'],
            'option_prices' => [5, 8, 3, 0],
            'default_value' => 'Grommets',
            'display_order' => 4,
            'is_required' => false,
        ]);
    }

    private function addStickerOptions($product)
    {
        // Size option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Sticker Size',
            'option_type' => 'button',
            'option_values' => ['2×2"', '3×3"', '4×4"', '4×6"', 'Custom Size'],
            'option_prices' => [0, 2, 4, 6, 0],
            'default_value' => '3×3"',
            'display_order' => 2,
            'is_required' => true,
        ]);

        // Material
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Material',
            'option_type' => 'tabs',
            'option_values' => ['White Vinyl', 'Clear Vinyl', 'Holographic', 'Kraft Paper'],
            'option_prices' => [0, 3, 8, 2],
            'default_value' => 'White Vinyl',
            'display_order' => 3,
            'is_required' => true,
        ]);

        // Shape
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Shape',
            'option_type' => 'button',
            'option_values' => ['Square', 'Circle', 'Rounded Rectangle', 'Die-Cut'],
            'option_prices' => [0, 0, 0, 5],
            'default_value' => 'Square',
            'display_order' => 4,
            'is_required' => true,
        ]);

        // Finish
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Finish',
            'option_type' => 'tabs',
            'option_values' => ['Gloss', 'Matte', 'High Gloss UV'],
            'option_prices' => [0, 0, 3],
            'default_value' => 'Gloss',
            'display_order' => 5,
            'is_required' => false,
        ]);
    }

    private function addBrochureOptions($product)
    {
        // Size option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Size',
            'option_type' => 'button',
            'option_values' => ['A4', 'A5', 'DL (99×210mm)', 'Letter'],
            'option_prices' => [0, 0, 0, 2],
            'default_value' => 'A4',
            'display_order' => 2,
            'is_required' => true,
        ]);

        // Fold type
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Fold Type',
            'option_type' => 'button',
            'option_values' => ['Bi-Fold', 'Tri-Fold', 'Z-Fold', 'Gate Fold', 'No Fold'],
            'option_prices' => [0, 2, 3, 5, 0],
            'default_value' => 'Tri-Fold',
            'display_order' => 3,
            'is_required' => true,
        ]);

        // Paper type
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Paper Type',
            'option_type' => 'tabs',
            'option_values' => ['130gsm Gloss', '170gsm Gloss', '250gsm Silk', '300gsm Matt'],
            'option_prices' => [0, 3, 6, 8],
            'default_value' => '130gsm Gloss',
            'display_order' => 4,
            'is_required' => true,
        ]);

        // Finish
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Finish',
            'option_type' => 'tabs',
            'option_values' => ['Gloss', 'Matte', 'Uncoated'],
            'option_prices' => [0, 0, 0],
            'default_value' => 'Gloss',
            'display_order' => 5,
            'is_required' => false,
        ]);
    }

    private function addStationeryOptions($product)
    {
        // Size option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Size',
            'option_type' => 'button',
            'option_values' => ['A4', 'A5', 'A6', 'Custom Size'],
            'option_prices' => [0, 0, 0, 5],
            'default_value' => 'A4',
            'display_order' => 2,
            'is_required' => true,
        ]);

        // Paper type
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Paper Type',
            'option_type' => 'tabs',
            'option_values' => ['80gsm Bond', '100gsm Premium', '120gsm Laid', '160gsm Card'],
            'option_prices' => [0, 3, 5, 8],
            'default_value' => '100gsm Premium',
            'display_order' => 3,
            'is_required' => true,
        ]);

        // Print type
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Print Type',
            'option_type' => 'radio',
            'option_values' => ['Full Color', 'Black & White', 'Spot Color'],
            'option_prices' => [5, 0, 3],
            'default_value' => 'Full Color',
            'display_order' => 4,
            'is_required' => true,
        ]);

        // Printed sides
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Printed Sides',
            'option_type' => 'tabs',
            'option_values' => ['Single Side', 'Double Side'],
            'option_prices' => [0, 5],
            'default_value' => 'Single Side',
            'display_order' => 5,
            'is_required' => true,
        ]);
    }

    private function addGenericOptions($product)
    {
        // Size option
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Size',
            'option_type' => 'button',
            'option_values' => ['Small', 'Medium', 'Large', 'Custom'],
            'option_prices' => [0, 5, 10, 15],
            'default_value' => 'Medium',
            'display_order' => 2,
            'is_required' => true,
        ]);

        // Material
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Material',
            'option_type' => 'tabs',
            'option_values' => ['Standard', 'Premium', 'Eco-Friendly'],
            'option_prices' => [0, 8, 5],
            'default_value' => 'Standard',
            'display_order' => 3,
            'is_required' => true,
        ]);

        // Finish
        ServiceConfigOption::create([
            'service_product_id' => $product->id,
            'option_name' => 'Finish',
            'option_type' => 'tabs',
            'option_values' => ['Gloss', 'Matte', 'Satin'],
            'option_prices' => [0, 0, 2],
            'default_value' => 'Gloss',
            'display_order' => 4,
            'is_required' => false,
        ]);
    }
}
