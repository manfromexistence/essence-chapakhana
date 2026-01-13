<?php

namespace Database\Seeders;

use App\Models\CheckoutField;
use Illuminate\Database\Seeder;

class CheckoutFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            // Shipping Information
            [
                'section' => 'shipping',
                'field_key' => 'shipping_name',
                'label' => 'Full Name',
                'placeholder' => 'Enter your full name',
                'type' => 'text',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'section' => 'shipping',
                'field_key' => 'shipping_email',
                'label' => 'Email Address',
                'placeholder' => 'Enter your email',
                'type' => 'email',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'section' => 'shipping',
                'field_key' => 'shipping_phone',
                'label' => 'Phone Number',
                'placeholder' => 'Enter your phone number',
                'type' => 'tel',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'section' => 'shipping',
                'field_key' => 'shipping_country',
                'label' => 'Country',
                'placeholder' => 'Enter your country',
                'type' => 'text',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'section' => 'shipping',
                'field_key' => 'shipping_address',
                'label' => 'Street Address',
                'placeholder' => 'Enter street address',
                'type' => 'textarea',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 5,
            ],
            [
                'section' => 'shipping',
                'field_key' => 'shipping_city',
                'label' => 'City',
                'placeholder' => 'Enter city',
                'type' => 'text',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 6,
            ],
            [
                'section' => 'shipping',
                'field_key' => 'shipping_state',
                'label' => 'State/Province',
                'placeholder' => 'Enter state',
                'type' => 'text',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 7,
            ],
            [
                'section' => 'shipping',
                'field_key' => 'shipping_zip',
                'label' => 'ZIP/Postal Code',
                'placeholder' => 'Enter zip code',
                'type' => 'text',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 8,
            ],

            // Payment Methods
            [
                'section' => 'payment',
                'field_key' => 'payment_method',
                'label' => 'Payment Method',
                'placeholder' => null,
                'type' => 'radio',
                'is_required' => true,
                'is_visible' => true,
                'sort_order' => 9,
                'options' => [
                    ['value' => 'credit_card', 'label' => 'Credit Card', 'description' => 'Visa, Mastercard, Amex'],
                    ['value' => 'paypal', 'label' => 'PayPal', 'description' => 'Pay with your PayPal account'],
                    ['value' => 'cash_on_delivery', 'label' => 'Cash on Delivery', 'description' => 'Pay when you receive your order'],
                ],
            ],

            // Order Notes
            [
                'section' => 'notes',
                'field_key' => 'notes',
                'label' => 'Order Notes (Optional)',
                'placeholder' => 'Any special instructions for your order?',
                'type' => 'textarea',
                'is_required' => false,
                'is_visible' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($fields as $field) {
            CheckoutField::create($field);
        }
    }
}
