@extends('admin.layouts.app')

@section('title', 'Checkout Fields | Admin Dashboard')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Checkout Form Fields</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Sort</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Section</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Label</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Key</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Required</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Visible</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($fields as $field)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $field->sort_order }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-xs uppercase font-bold">
                            {{ $field->section }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $field->label }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $field->field_key }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($field->is_required)
                            <span class="text-green-600">Yes</span>
                        @else
                            <span class="text-gray-400">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($field->is_visible)
                            <span class="text-blue-600 font-medium">Visible</span>
                        @else
                            <span class="text-red-400">Hidden</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.checkout-fields.edit', $field) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition inline-block">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
