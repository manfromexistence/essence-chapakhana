<?php

namespace Database\Seeders;

use App\Models\Category;
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
            // Books Category (5 products)
            ['category' => 'Books', 'title' => 'Paperback Novel Bundle', 'description' => 'Lightweight novel-ready sets with recycled interiors.', 'format' => 'Paperback', 'price' => 850, 'rating' => 4.6, 'popularity' => 95, 'stock' => true, 'badge' => 'New', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],
            ['category' => 'Books', 'title' => 'Hardback Photo Album', 'description' => 'Gallery-grade binding with matte cover options.', 'format' => 'Hardback', 'price' => 2400, 'rating' => 4.8, 'popularity' => 91, 'stock' => true, 'badge' => 'Bestseller', 'image' => 'https://images.unsplash.com/photo-1457694587812-e8bf29a43845?w=500&h=420&fit=crop'],
            ['category' => 'Books', 'title' => 'Layflat Portfolio Book', 'description' => 'Seamless spreads ideal for photography and art.', 'format' => 'Layflat', 'price' => 3800, 'rating' => 4.9, 'popularity' => 77, 'stock' => true, 'badge' => 'Premium', 'image' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=500&h=420&fit=crop'],
            ['category' => 'Books', 'title' => 'Cookbook Deluxe', 'description' => 'Oil-resistant papers with foil accents for recipes.', 'format' => 'Cookbook', 'price' => 1950, 'rating' => 4.5, 'popularity' => 83, 'stock' => true, 'badge' => 'Popular', 'image' => 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=500&h=420&fit=crop'],
            ['category' => 'Books', 'title' => 'Pocket Zine Collection', 'description' => 'Short-run zines with uncoated feel for indie publishers.', 'format' => 'Pocket', 'price' => 380, 'rating' => 4.3, 'popularity' => 69, 'stock' => true, 'badge' => 'Indie', 'image' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?w=500&h=420&fit=crop'],

            // Magazines Category (4 products)
            ['category' => 'Magazines', 'title' => 'Fashion Magazine Premium', 'description' => 'High-gloss fashion magazines with premium paper stock.', 'format' => 'Magazine', 'price' => 520, 'rating' => 4.6, 'popularity' => 88, 'stock' => true, 'badge' => 'Glossy', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],
            ['category' => 'Magazines', 'title' => 'Corporate Magazine', 'description' => 'Professional magazines for corporate communications.', 'format' => 'Magazine', 'price' => 650, 'rating' => 4.7, 'popularity' => 82, 'stock' => true, 'badge' => 'Business', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],
            ['category' => 'Magazines', 'title' => 'Lifestyle Magazine', 'description' => 'Vibrant lifestyle magazines with full-color printing.', 'format' => 'Magazine', 'price' => 480, 'rating' => 4.5, 'popularity' => 85, 'stock' => true, 'badge' => 'Colorful', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],
            ['category' => 'Magazines', 'title' => 'Trade Magazine', 'description' => 'Industry-specific trade magazines with matte finish.', 'format' => 'Magazine', 'price' => 590, 'rating' => 4.4, 'popularity' => 78, 'stock' => true, 'badge' => 'Professional', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],

            // Catalogs Category (4 products)
            ['category' => 'Catalogs', 'title' => 'Product Catalog Standard', 'description' => 'Multi-page catalogs with spot UV finish.', 'format' => 'Catalog', 'price' => 710, 'rating' => 4.4, 'popularity' => 79, 'stock' => true, 'badge' => 'Standard', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500&h=420&fit=crop'],
            ['category' => 'Catalogs', 'title' => 'Sales Catalog Premium', 'description' => 'Premium catalogs with embossed covers and thick pages.', 'format' => 'Catalog', 'price' => 950, 'rating' => 4.7, 'popularity' => 85, 'stock' => true, 'badge' => 'Premium', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500&h=420&fit=crop'],
            ['category' => 'Catalogs', 'title' => 'Digital Catalog Print', 'description' => 'High-quality digital printing for quick turnaround.', 'format' => 'Catalog', 'price' => 620, 'rating' => 4.3, 'popularity' => 76, 'stock' => true, 'badge' => 'Fast', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500&h=420&fit=crop'],
            ['category' => 'Catalogs', 'title' => 'Luxury Catalog', 'description' => 'Luxury catalogs with gold foil and special finishes.', 'format' => 'Catalog', 'price' => 1280, 'rating' => 4.8, 'popularity' => 88, 'stock' => true, 'badge' => 'Luxury', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500&h=420&fit=crop'],

            // Brochures Category (4 products)
            ['category' => 'Brochures', 'title' => 'Tri-Fold Brochure', 'description' => 'Professional tri-fold brochures with glossy finish.', 'format' => 'Brochure', 'price' => 250, 'rating' => 4.5, 'popularity' => 90, 'stock' => true, 'badge' => 'Popular', 'image' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=420&fit=crop'],
            ['category' => 'Brochures', 'title' => 'Bi-Fold Brochure', 'description' => 'Simple bi-fold brochures for quick promotions.', 'format' => 'Brochure', 'price' => 180, 'rating' => 4.4, 'popularity' => 87, 'stock' => true, 'badge' => 'Budget', 'image' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=420&fit=crop'],
            ['category' => 'Brochures', 'title' => 'Z-Fold Brochure', 'description' => 'Creative z-fold design for maximum impact.', 'format' => 'Brochure', 'price' => 290, 'rating' => 4.6, 'popularity' => 84, 'stock' => true, 'badge' => 'Creative', 'image' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=420&fit=crop'],
            ['category' => 'Brochures', 'title' => 'Gate Fold Brochure', 'description' => 'Premium gate fold brochures with matte lamination.', 'format' => 'Brochure', 'price' => 350, 'rating' => 4.7, 'popularity' => 82, 'stock' => true, 'badge' => 'Premium', 'image' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=420&fit=crop'],

            // Business Cards Category (4 products)
            ['category' => 'Business Cards', 'title' => 'Standard Business Cards', 'description' => 'Classic business cards on quality card stock.', 'format' => 'Card', 'price' => 120, 'rating' => 4.5, 'popularity' => 95, 'stock' => true, 'badge' => 'Bestseller', 'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=500&h=420&fit=crop'],
            ['category' => 'Business Cards', 'title' => 'Premium Business Cards', 'description' => 'Thick stock business cards with matte lamination.', 'format' => 'Card', 'price' => 180, 'rating' => 4.7, 'popularity' => 92, 'stock' => true, 'badge' => 'Premium', 'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=500&h=420&fit=crop'],
            ['category' => 'Business Cards', 'title' => 'Luxury Business Cards', 'description' => 'Ultra-thick cards with gold foil stamping.', 'format' => 'Card', 'price' => 280, 'rating' => 4.9, 'popularity' => 88, 'stock' => true, 'badge' => 'Luxury', 'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=500&h=420&fit=crop'],
            ['category' => 'Business Cards', 'title' => 'Spot UV Business Cards', 'description' => 'Business cards with spot UV coating for shine.', 'format' => 'Card', 'price' => 220, 'rating' => 4.6, 'popularity' => 86, 'stock' => true, 'badge' => 'Shiny', 'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=500&h=420&fit=crop'],

            // Invitation & Stationery Category (4 products)
            ['category' => 'Invitation & Stationery', 'title' => 'Wedding Invitation Suite', 'description' => 'Elegant wedding invitations with RSVP cards.', 'format' => 'Invitation', 'price' => 580, 'rating' => 4.8, 'popularity' => 92, 'stock' => true, 'badge' => 'Premium', 'image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=500&h=420&fit=crop'],
            ['category' => 'Invitation & Stationery', 'title' => 'Event Invitation Cards', 'description' => 'Professional event invitations for corporate functions.', 'format' => 'Invitation', 'price' => 320, 'rating' => 4.6, 'popularity' => 84, 'stock' => true, 'badge' => 'Corporate', 'image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=500&h=420&fit=crop'],
            ['category' => 'Invitation & Stationery', 'title' => 'Birthday Invitation Pack', 'description' => 'Colorful birthday invitations for all ages.', 'format' => 'Invitation', 'price' => 280, 'rating' => 4.5, 'popularity' => 88, 'stock' => true, 'badge' => 'Fun', 'image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=500&h=420&fit=crop'],
            ['category' => 'Invitation & Stationery', 'title' => 'Thank You Cards', 'description' => 'Elegant thank you cards with envelopes.', 'format' => 'Card', 'price' => 220, 'rating' => 4.4, 'popularity' => 80, 'stock' => true, 'badge' => 'Classic', 'image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=500&h=420&fit=crop'],

            // Banners Category (4 products)
            ['category' => 'Banners', 'title' => 'Vinyl Banner Large', 'description' => 'Weather-resistant vinyl banners for outdoor events.', 'format' => 'Banner', 'price' => 1850, 'rating' => 4.6, 'popularity' => 81, 'stock' => true, 'badge' => 'Outdoor', 'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=500&h=420&fit=crop'],
            ['category' => 'Banners', 'title' => 'Retractable Banner Stand', 'description' => 'Portable retractable banners with carrying case.', 'format' => 'Banner', 'price' => 2200, 'rating' => 4.7, 'popularity' => 86, 'stock' => true, 'badge' => 'Portable', 'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=500&h=420&fit=crop'],
            ['category' => 'Banners', 'title' => 'Mesh Banner', 'description' => 'Wind-resistant mesh banners for outdoor use.', 'format' => 'Banner', 'price' => 1650, 'rating' => 4.5, 'popularity' => 78, 'stock' => true, 'badge' => 'Durable', 'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=500&h=420&fit=crop'],
            ['category' => 'Banners', 'title' => 'Fabric Banner', 'description' => 'Premium fabric banners with vibrant colors.', 'format' => 'Banner', 'price' => 1980, 'rating' => 4.8, 'popularity' => 84, 'stock' => true, 'badge' => 'Premium', 'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=500&h=420&fit=crop'],

            // Promotional Items Category (4 products)
            ['category' => 'Promotional Items', 'title' => 'Branded Tote Bags', 'description' => 'Eco-friendly canvas tote bags with custom printing.', 'format' => 'Bag', 'price' => 675, 'rating' => 4.5, 'popularity' => 89, 'stock' => true, 'badge' => 'Eco', 'image' => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=500&h=420&fit=crop'],
            ['category' => 'Promotional Items', 'title' => 'Custom Pens Bulk', 'description' => 'Quality promotional pens with logo printing.', 'format' => 'Pen', 'price' => 230, 'rating' => 4.2, 'popularity' => 78, 'stock' => true, 'badge' => 'Bulk', 'image' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=420&fit=crop'],
            ['category' => 'Promotional Items', 'title' => 'Branded Mugs', 'description' => 'Ceramic mugs with full-color logo printing.', 'format' => 'Mug', 'price' => 450, 'rating' => 4.6, 'popularity' => 85, 'stock' => true, 'badge' => 'Popular', 'image' => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=500&h=420&fit=crop'],
            ['category' => 'Promotional Items', 'title' => 'Custom Keychains', 'description' => 'Metal keychains with engraved or printed logos.', 'format' => 'Keychain', 'price' => 180, 'rating' => 4.3, 'popularity' => 82, 'stock' => true, 'badge' => 'Affordable', 'image' => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=500&h=420&fit=crop'],

            // Stickers Category (4 products)
            ['category' => 'Stickers', 'title' => 'Custom Sticker Sheets', 'description' => 'Die-cut stickers on sheets with UV coating.', 'format' => 'Sticker', 'price' => 450, 'rating' => 4.7, 'popularity' => 93, 'stock' => true, 'badge' => 'Popular', 'image' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=500&h=420&fit=crop'],
            ['category' => 'Stickers', 'title' => 'Vinyl Sticker Roll', 'description' => 'Waterproof vinyl stickers on rolls.', 'format' => 'Sticker', 'price' => 580, 'rating' => 4.8, 'popularity' => 91, 'stock' => true, 'badge' => 'Waterproof', 'image' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=500&h=420&fit=crop'],
            ['category' => 'Stickers', 'title' => 'Bumper Stickers', 'description' => 'Durable bumper stickers for vehicles.', 'format' => 'Sticker', 'price' => 320, 'rating' => 4.5, 'popularity' => 86, 'stock' => true, 'badge' => 'Durable', 'image' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=500&h=420&fit=crop'],
            ['category' => 'Stickers', 'title' => 'Clear Stickers', 'description' => 'Transparent stickers with white ink backing.', 'format' => 'Sticker', 'price' => 520, 'rating' => 4.6, 'popularity' => 88, 'stock' => true, 'badge' => 'Unique', 'image' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=500&h=420&fit=crop'],

            // Booklets Category (4 products)
            ['category' => 'Booklets', 'title' => 'Saddle Stitch Booklet', 'description' => 'Multi-page booklets with saddle stitch binding.', 'format' => 'Booklet', 'price' => 380, 'rating' => 4.4, 'popularity' => 76, 'stock' => true, 'badge' => 'Standard', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],
            ['category' => 'Booklets', 'title' => 'Perfect Bound Booklet', 'description' => 'Professional booklets with perfect binding.', 'format' => 'Booklet', 'price' => 520, 'rating' => 4.6, 'popularity' => 82, 'stock' => true, 'badge' => 'Professional', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],
            ['category' => 'Booklets', 'title' => 'Spiral Bound Booklet', 'description' => 'Spiral bound booklets that lay flat when open.', 'format' => 'Booklet', 'price' => 450, 'rating' => 4.5, 'popularity' => 79, 'stock' => true, 'badge' => 'Practical', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],
            ['category' => 'Booklets', 'title' => 'Wire-O Booklet', 'description' => 'Wire-O bound booklets for presentations.', 'format' => 'Booklet', 'price' => 490, 'rating' => 4.7, 'popularity' => 84, 'stock' => true, 'badge' => 'Premium', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500&h=420&fit=crop'],

            // Marketing Category (3 products)
            ['category' => 'Marketing', 'title' => 'Marketing Kit Bundle', 'description' => 'Complete marketing materials bundle with everything you need.', 'format' => 'Bundle', 'price' => 2675, 'rating' => 4.7, 'popularity' => 85, 'stock' => true, 'badge' => 'Bundle', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=420&fit=crop'],
            ['category' => 'Marketing', 'title' => 'Flyer Pack', 'description' => 'High-quality flyers for promotions and events.', 'format' => 'Flyer', 'price' => 320, 'rating' => 4.5, 'popularity' => 88, 'stock' => true, 'badge' => 'Popular', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=420&fit=crop'],
            ['category' => 'Marketing', 'title' => 'Postcard Marketing', 'description' => 'Direct mail postcards with full-color printing.', 'format' => 'Postcard', 'price' => 280, 'rating' => 4.4, 'popularity' => 82, 'stock' => true, 'badge' => 'Direct Mail', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=420&fit=crop'],

            // Stationery Category (3 products)
            ['category' => 'Stationery', 'title' => 'Letterhead Premium', 'description' => 'Professional letterheads on premium paper stock.', 'format' => 'Letterhead', 'price' => 350, 'rating' => 4.5, 'popularity' => 80, 'stock' => true, 'badge' => 'Professional', 'image' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=420&fit=crop'],
            ['category' => 'Stationery', 'title' => 'Envelopes Custom', 'description' => 'Custom printed envelopes in various sizes.', 'format' => 'Envelope', 'price' => 220, 'rating' => 4.3, 'popularity' => 75, 'stock' => true, 'badge' => 'Custom', 'image' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=420&fit=crop'],
            ['category' => 'Stationery', 'title' => 'Notepad Set', 'description' => 'Branded notepads with custom headers.', 'format' => 'Notepad', 'price' => 380, 'rating' => 4.4, 'popularity' => 78, 'stock' => true, 'badge' => 'Useful', 'image' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=420&fit=crop'],

            // Signage Category (3 products)
            ['category' => 'Signage', 'title' => 'Large Format Poster', 'description' => 'Vibrant latex inks for outdoor durability.', 'format' => 'Poster', 'price' => 1200, 'rating' => 4.7, 'popularity' => 86, 'stock' => true, 'badge' => 'UV Safe', 'image' => 'https://images.unsplash.com/photo-1522199710521-72d69614c702?w=500&h=420&fit=crop'],
            ['category' => 'Signage', 'title' => 'Yard Signs', 'description' => 'Corrugated plastic yard signs with stakes.', 'format' => 'Sign', 'price' => 850, 'rating' => 4.5, 'popularity' => 82, 'stock' => true, 'badge' => 'Outdoor', 'image' => 'https://images.unsplash.com/photo-1522199710521-72d69614c702?w=500&h=420&fit=crop'],
            ['category' => 'Signage', 'title' => 'Window Decals', 'description' => 'Adhesive window decals for storefronts.', 'format' => 'Decal', 'price' => 680, 'rating' => 4.6, 'popularity' => 84, 'stock' => true, 'badge' => 'Adhesive', 'image' => 'https://images.unsplash.com/photo-1522199710521-72d69614c702?w=500&h=420&fit=crop'],

            // Packaging Category (3 products)
            ['category' => 'Packaging', 'title' => 'Custom Product Boxes', 'description' => 'Rigid boxes with embossing and custom inserts.', 'format' => 'Box', 'price' => 2900, 'rating' => 4.6, 'popularity' => 83, 'stock' => true, 'badge' => 'Custom', 'image' => 'https://images.unsplash.com/photo-1453689472869-23f81f0b89dd?w=500&h=420&fit=crop'],
            ['category' => 'Packaging', 'title' => 'Shipping Boxes', 'description' => 'Corrugated shipping boxes with custom printing.', 'format' => 'Box', 'price' => 580, 'rating' => 4.4, 'popularity' => 88, 'stock' => true, 'badge' => 'Shipping', 'image' => 'https://images.unsplash.com/photo-1453689472869-23f81f0b89dd?w=500&h=420&fit=crop'],
            ['category' => 'Packaging', 'title' => 'Gift Boxes', 'description' => 'Premium gift boxes with ribbon and inserts.', 'format' => 'Box', 'price' => 1250, 'rating' => 4.7, 'popularity' => 86, 'stock' => true, 'badge' => 'Gift', 'image' => 'https://images.unsplash.com/photo-1453689472869-23f81f0b89dd?w=500&h=420&fit=crop'],
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();

            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'title' => $productData['title'],
                    'slug' => \Illuminate\Support\Str::slug($productData['title']),
                    'description' => $productData['description'],
                    'format' => $productData['format'],
                    'price' => $productData['price'],
                    'rating' => $productData['rating'],
                    'popularity' => $productData['popularity'],
                    'stock' => $productData['stock'],
                    'badge' => $productData['badge'],
                    'image' => $productData['image'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
