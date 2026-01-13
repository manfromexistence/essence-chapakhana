<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Home Page Sections
        $this->seedHomePageSections();

        // Header Sections
        $this->seedHeaderSections();

        // Footer Sections
        $this->seedFooterSections();

        // Category Page Templates
        $this->seedCategoryPages();
    }

    private function seedHomePageSections(): void
    {
        // Hero Slider
        PageSection::setSection('home', 'hero_slider', [
            'slides' => [
                [
                    'title' => 'আপনার গল্প, আমাদের ছাপা',
                    'subtitle' => 'মানসম্মত প্রিন্টিং সেবা, সাশ্রয়ী মূল্যে',
                    'image' => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=1920&h=600&fit=crop',
                    'cta_text' => '',
                    'cta_url' => '',
                ],
                [
                    'title' => 'শুধু প্রিন্টার নয়, আপনার বিশ্বস্ত সঙ্গী',
                    'subtitle' => 'প্রতিটি পদক্ষেপে আমরা আছি আপনার পাশে',
                    'image' => 'https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=1920&h=600&fit=crop',
                    'cta_text' => 'যোগাযোগ করুন',
                    'cta_url' => '/contact',
                ],
                [
                    'title' => 'আপনার আইডিয়াকে বাস্তবে রূপান্তরিত করুন',
                    'subtitle' => 'দেশসেরা মানের প্রিন্টিং এ',
                    'image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=1920&h=600&fit=crop',
                    'cta_text' => '',
                    'cta_url' => '',
                ],
            ],
            'stats' => [
                'percentage' => '93',
                'label' => 'of our customers would buy again from Chapakhana',
                'reviews_count' => '256,839',
            ],
        ], 'Hero Slider');

        // Headline Section
        PageSection::setSection('home', 'headline', [
            'title' => 'আপনার স্বপ্নকে বাস্তবে রূপান্তরিত করুন',
            'description' => 'চাপাখানা হলো আপনার বিশ্বস্ত প্রিন্টিং সঙ্গী। উচ্চমানের প্রিন্টিং সেবা, দ্রুত ডেলিভারি এবং প্রতিযোগিতামূলক মূল্যে আমরা আপনার ব্যবসায়িক লক্ষ্য অর্জনে সহায়তা করি। বই, ম্যাগাজিন, ব্যানার থেকে শুরু করে সকল ধরনের মার্কেটিং ম্যাটেরিয়াল - সবকিছুই পাবেন এক জায়গায়।',
        ], 'Headline Section');

        // How to Order Section
        PageSection::setSection('home', 'how_to_order', [
            'title' => '০ টাকা বিনিয়োগে শুরু করুন',
            'video_url' => '/videos/how-it-works.mp4',
            'video_poster' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=1200&h=1200&fit=crop',
            'steps' => [
                [
                    'number' => '১',
                    'title' => 'পণ্য নির্বাচন করুন',
                    'description' => '১০০০+ উচ্চমানের পণ্য থেকে আপনার পছন্দের পণ্য বেছে নিন',
                ],
                [
                    'number' => '২',
                    'title' => 'ডিজাইন যুক্ত করুন',
                    'description' => 'সহজ এবং মজাদার উপায়ে আপনার পণ্যের ডিজাইন করুন!',
                ],
                [
                    'number' => '৩',
                    'title' => 'বিক্রয় শুরু করুন',
                    'description' => 'আপনি লাভের মার্জিন নির্ধারণ করুন, উৎপাদন ও ডেলিভারি আমরা করবো',
                ],
            ],
            'cta_primary' => ['text' => 'ডিজাইন শুরু করুন', 'url' => '/shop'],
            'cta_secondary' => ['text' => 'আরও জানুন', 'url' => '#learn-more'],
        ], 'How to Order');

        // Best Sellers Section
        PageSection::setSection('home', 'best_sellers', [
            'title' => 'জনপ্রিয় পণ্য',
            'products' => [
                ['title' => 'Magazines', 'url' => '/magazines', 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400&h=400&fit=crop'],
                ['title' => 'Books', 'url' => '/books', 'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=400&fit=crop'],
                ['title' => 'Catalog', 'url' => '/catalogs', 'image' => 'https://images.unsplash.com/photo-1489515217757-5fd1be406fef?w=400&h=400&fit=crop'],
                ['title' => 'Marketing Material', 'url' => '/brochures', 'image' => 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=400&h=400&fit=crop'],
                ['title' => 'Business Cards', 'url' => '/business-cards', 'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=400&h=400&fit=crop'],
                ['title' => 'Invitation & Stationery', 'url' => '/postcards-invitations', 'image' => 'https://images.unsplash.com/photo-1557682224-5b8590cd9ec5?w=400&h=400&fit=crop'],
                ['title' => 'Banners', 'url' => '/banners', 'image' => 'https://images.unsplash.com/photo-1504198458632-1631c46f4506?w=400&h=400&fit=crop'],
                ['title' => 'Promotional Items', 'url' => '/promotional-items', 'image' => 'https://images.unsplash.com/photo-1611532736579-6b16e2b50449?w=400&h=400&fit=crop'],
            ],
        ], 'Best Sellers');

        // Testimonials Section
        PageSection::setSection('home', 'testimonials', [
            'title' => 'গ্রাহকদের মতামত',
            'subtitle' => 'সারা বাংলাদেশ জুড়ে হাজারো ব্যবসায়ীর বিশ্বস্ত সঙ্গী',
            'items' => [
                [
                    'text' => 'অসাধারণ প্রিন্ট কোয়ালিটি এবং দ্রুত ডেলিভারি! আমাদের সব মার্কেটিং ম্যাটেরিয়ালের জন্য চাপাখানা এখন প্রথম পছন্দ। অবশ্যই সুপারিশ করব!',
                    'author' => 'আহমেদ রহমান',
                    'designation' => 'সিইও, টেক সলিউশন্স লিমিটেড',
                    'avatar_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face',
                    'avatar_initial' => 'আ',
                    'avatar_color' => 'green',
                    'rating' => 5,
                ],
                [
                    'text' => 'চমৎকার সেবা এবং সাশ্রয়ী মূল্য। আমাদের কোম্পানির ক্যাটালগ তারা অসাধারণভাবে প্রিন্ট করেছে এবং সময়মতো ডেলিভারি দিয়েছে। আবারও ব্যবহার করবো!',
                    'author' => 'সাদিয়া করিম',
                    'designation' => 'মার্কেটিং ম্যানেজার, ফ্যাশন হাব',
                    'avatar_image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop&crop=face',
                    'avatar_initial' => 'সা',
                    'avatar_color' => 'orange',
                    'rating' => 5,
                ],
                [
                    'text' => 'পেশাদার টিম এবং দারুণ কাস্টমার সাপোর্ট। আমাদের বিয়ের কার্ড ডিজাইন ও প্রিন্ট করতে তারা সাহায্য করেছে। ধন্যবাদ চাপাখানা!',
                    'author' => 'রফিক হোসেন',
                    'designation' => 'ব্যবসায়ী',
                    'avatar_image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face',
                    'avatar_initial' => 'র',
                    'avatar_color' => 'red',
                    'rating' => 5,
                ],
            ],
        ], 'Testimonials');

        // Offer Banner Section
        PageSection::setSection('home', 'offer_banner', [
            'title' => 'বিশেষ অফার!',
            'subtitle' => 'প্রথম অর্ডারে পাচ্ছেন ২০% ছাড়',
            'description' => 'নতুন গ্রাহকরা সকল প্রিন্টিং সার্ভিসে বিশেষ ছাড় উপভোগ করতে পারবেন। সীমিত সময়ের অফার!',
            'cta_text' => 'এখনই অফার নিন',
            'cta_url' => '/shop',
            'background_gradient' => 'from-green-600 to-green-800',
        ], 'Offer Banner');

        // Trust Section
        PageSection::setSection('home', 'trust_section', [
            'title' => 'যারা আমাদের বিশ্বাস করেন',
            'subtitle' => 'শত শত প্রতিষ্ঠান তাদের প্রিন্টিং এর জন্য আমাদের উপর আস্থা রাখেন',
            'brands' => [
                ['name' => 'TechCorp', 'logo' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?w=200&h=100&fit=crop'],
                ['name' => 'MediaHub', 'logo' => 'https://images.unsplash.com/photo-1614680376593-902f74cf0d41?w=200&h=100&fit=crop'],
                ['name' => 'PrintPro', 'logo' => 'https://images.unsplash.com/photo-1614680376408-81e91ffe3db7?w=200&h=100&fit=crop'],
                ['name' => 'DesignLab', 'logo' => 'https://images.unsplash.com/photo-1599305446868-59e861c19d3e?w=200&h=100&fit=crop'],
                ['name' => 'BrandMax', 'logo' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?w=200&h=100&fit=crop'],
                ['name' => 'CreativeStudio', 'logo' => 'https://images.unsplash.com/photo-1614680376593-902f74cf0d41?w=200&h=100&fit=crop'],
                ['name' => 'AdVenture', 'logo' => 'https://images.unsplash.com/photo-1614680376408-81e91ffe3db7?w=200&h=100&fit=crop'],
                ['name' => 'MarketEdge', 'logo' => 'https://images.unsplash.com/photo-1599305446868-59e861c19d3e?w=200&h=100&fit=crop'],
            ],
        ], 'Trust Section');
    }

    private function seedHeaderSections(): void
    {
        PageSection::setSection('header', 'main', [
            'site_name' => 'Chapakhana',
            'logo' => '/logo.png',
            'phone' => '+880 1XXX-XXXXXX',
            'navigation' => [
                ['title' => 'Home', 'url' => '/', 'pattern' => '/'],
                ['title' => 'Shop', 'url' => '/shop', 'pattern' => 'shop'],
                ['title' => 'Magazines', 'url' => '/magazines', 'pattern' => 'magazines*'],
                ['title' => 'Books', 'url' => '/books', 'pattern' => 'books*'],
                ['title' => 'Catalog', 'url' => '/catalogs', 'pattern' => 'catalogs*'],
                ['title' => 'Marketing Material', 'url' => '/brochures', 'pattern' => 'brochures*'],
                ['title' => 'Business Cards', 'url' => '/business-cards', 'pattern' => 'business-cards*'],
                ['title' => 'Invitation & Stationery', 'url' => '/postcards-invitations', 'pattern' => 'postcards-invitations*'],
                ['title' => 'Banners', 'url' => '/banners', 'pattern' => 'banners*'],
                ['title' => 'Promotional Items', 'url' => '/promotional-items', 'pattern' => 'promotional-items*'],
            ],
        ], 'Header');
    }

    private function seedFooterSections(): void
    {
        PageSection::setSection('footer', 'main', [
            'logo' => '/logo.png',
            'company_info' => [
                'name' => 'Chapakhana',
                'description' => 'আপনার বিশ্বস্ত প্রিন্টিং সঙ্গী। উচ্চমানের প্রিন্টিং সেবা, দ্রুত ডেলিভারি।',
            ],
            'contact' => [
                'address' => 'ঢাকা, বাংলাদেশ',
                'phone' => '+880 1XXX-XXXXXX',
                'email' => 'info@chapakhana.com',
            ],
            'social_links' => [
                ['platform' => 'facebook', 'url' => '#'],
                ['platform' => 'instagram', 'url' => '#'],
                ['platform' => 'twitter', 'url' => '#'],
            ],
            'quick_links' => [
                ['title' => 'About Us', 'url' => '/about'],
                ['title' => 'Contact', 'url' => '/contact'],
                ['title' => 'FAQ', 'url' => '/faq'],
                ['title' => 'Terms & Conditions', 'url' => '/terms'],
                ['title' => 'Privacy Policy', 'url' => '/privacy'],
            ],
            'copyright' => '© 2026 Chapakhana. All rights reserved.',
        ], 'Footer');
    }

    private function seedCategoryPages(): void
    {
        // Get defaults from PageSection model which includes products
        $categorySlugs = ['books', 'magazines', 'catalogs', 'brochures', 'business-cards', 'postcards-invitations', 'banners', 'promotional-items'];

        foreach ($categorySlugs as $slug) {
            $defaults = PageSection::getDefaults($slug);
            PageSection::setSection('category', $slug, $defaults, $defaults['title'] ?? ucfirst($slug));
        }
    }
}
