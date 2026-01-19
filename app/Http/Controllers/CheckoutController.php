<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Show the checkout form.
     */
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);

        // Redirect back to cart if cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = config('shop.tax_rate', 0.08);
        $taxAmount = $subtotal * $tax;
        $total = $subtotal + $taxAmount;

        // Fetch dynamic checkout fields
        $fields = \App\Models\CheckoutField::where('is_visible', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('section');

        return view('checkout.index', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => $taxAmount,
            'total' => $total,
            'itemCount' => count($cart),
            'user' => auth()->user(),
            'fields' => $fields,
        ]);
    }

    /**
     * Process the checkout.
     */
    public function process(Request $request)
    {
        // Standard required fields validation
        $rules = [
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:20',
            'has_design_request' => 'nullable|boolean',
            'design_request_notes' => 'nullable|string|max:2000',
            'design_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,ai,psd|max:10240',
        ];

        // Build dynamic validation for additional fields
        $fields = \App\Models\CheckoutField::where('is_visible', true)->get();

        foreach ($fields as $field) {
            $fieldRules = [];

            if ($field->is_required) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            if ($field->type == 'email') {
                $fieldRules[] = 'email';
            }

            if ($field->field_key == 'payment_method') {
                $fieldRules[] = 'in:credit_card,paypal,cash_on_delivery';
            } else {
                $fieldRules[] = 'string';
                $fieldRules[] = 'max:500';
            }

            $rules[$field->field_key] = implode('|', $fieldRules);
        }

        $validated = $request->validate($rules);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $taxAmount = $subtotal * 0.08;
        $total = $subtotal + $taxAmount;

        // Here you would typically:
        // 1. Create an order in the database
        // 2. Process payment
        // 3. Send confirmation email
        // 4. Clear the cart

        // For now, we'll just simulate success
        $orderNumber = 'ORD-'.strtoupper(uniqid());

        // Handle design file upload
        $designFilePath = null;
        if ($request->hasFile('design_file')) {
            $designFilePath = $request->file('design_file')->store('design-requests', 'public');
        }

        // Save order to database
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'order_number' => $orderNumber,
            'shipping_name' => $validated['shipping_name'] ?? auth()->user()->name,
            'shipping_email' => $validated['shipping_email'] ?? auth()->user()->email,
            'shipping_phone' => $validated['shipping_phone'] ?? null,
            'shipping_country' => $validated['shipping_country'] ?? null,
            'shipping_address' => $validated['shipping_address'] ?? null,
            'shipping_city' => $validated['shipping_city'] ?? null,
            'shipping_state' => $validated['shipping_state'] ?? null,
            'shipping_zip' => $validated['shipping_zip'] ?? null,
            'payment_method' => $validated['payment_method'] ?? 'cash_on_delivery',
            'notes' => $validated['notes'] ?? null,
            'has_design_request' => $request->boolean('has_design_request'),
            'design_request_notes' => $validated['design_request_notes'] ?? null,
            'design_file_path' => $designFilePath,
            'subtotal' => $subtotal,
            'tax' => $taxAmount,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'] ?? null,
                'product_title' => $item['title'],
                'product_image' => $item['image'],
                'format' => $item['format'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Store order details in session for confirmation page (if needed later)
        session()->put('last_order', [
            'order_number' => $orderNumber,
            'items' => $cart,
            'shipping' => $validated,
            'subtotal' => $subtotal,
            'tax' => $taxAmount,
            'total' => $total,
            'date' => now(),
        ]);

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

    /**
     * Show order success page.
     */
    public function success(Request $request)
    {
        $order = session()->get('last_order');

        if (! $order) {
            return redirect()->route('shop')->with('error', 'No order found!');
        }

        return view('checkout.success', ['order' => $order]);
    }
}
