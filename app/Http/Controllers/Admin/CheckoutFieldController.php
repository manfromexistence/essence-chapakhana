<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckoutField;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutFieldController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/CheckoutFields', [
            'fields' => Inertia::defer(fn () => CheckoutField::orderBy('section')->orderBy('sort_order')->get()),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|string|in:billing,shipping,additional',
            'field_key' => 'required|string|max:255|unique:checkout_fields,field_key',
            'label' => 'required|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'type' => 'required|string|in:text,email,tel,textarea,select,checkbox,radio',
            'is_required' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
            'options' => 'nullable|array',
        ]);

        $validated['is_required'] = $request->boolean('is_required');
        $validated['is_visible'] = $request->boolean('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        CheckoutField::create($validated);

        return redirect()->route('admin.checkout-fields.index')
            ->with('success', 'Checkout field created successfully!');
    }

    public function update(Request $request, CheckoutField $checkoutField)
    {
        $validated = $request->validate([
            'section' => 'required|string|in:billing,shipping,additional',
            'field_key' => 'required|string|max:255|unique:checkout_fields,field_key,'.$checkoutField->id,
            'label' => 'required|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'type' => 'required|string|in:text,email,tel,textarea,select,checkbox,radio',
            'is_required' => 'boolean',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer',
            'options' => 'nullable|array',
        ]);

        $validated['is_required'] = $request->boolean('is_required');
        $validated['is_visible'] = $request->boolean('is_visible');

        $checkoutField->update($validated);

        return redirect()->route('admin.checkout-fields.index')
            ->with('success', 'Checkout field updated successfully!');
    }

    public function destroy(CheckoutField $checkoutField)
    {
        $checkoutField->delete();

        return redirect()->route('admin.checkout-fields.index')
            ->with('success', 'Checkout field deleted successfully!');
    }

    public function toggleVisibility(Request $request, CheckoutField $checkoutField)
    {
        $checkoutField->update([
            'is_visible' => $request->boolean('is_visible'),
        ]);

        return back()->with('success', 'Field visibility updated!');
    }

    public function toggleRequired(Request $request, CheckoutField $checkoutField)
    {
        $checkoutField->update([
            'is_required' => $request->boolean('is_required'),
        ]);

        return back()->with('success', 'Field requirement updated!');
    }
}
