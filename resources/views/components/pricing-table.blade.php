@props(['prices' => [], 'title' => 'Pricing'])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm border border-gray-200 p-6']) }}>
    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $title }}</h3>
    
    @if(empty($prices))
        <p class="text-gray-600 text-sm">Contact us for pricing information</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-semibold text-gray-900">Quantity</th>
                        <th class="text-right py-3 px-2 font-semibold text-gray-900">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prices as $tier)
                        <tr class="border-b border-gray-100 last:border-0">
                            <td class="py-3 px-2 text-gray-700">
                                @if(isset($tier['min']) && isset($tier['max']))
                                    {{ $tier['min'] }} - {{ $tier['max'] }} units
                                @elseif(isset($tier['min']))
                                    {{ $tier['min'] }}+ units
                                @else
                                    {{ $tier['quantity'] ?? 'N/A' }}
                                @endif
                            </td>
                            <td class="py-3 px-2 text-right font-medium text-gray-900">
                                ৳{{ number_format($tier['price'], 2) }}
                                @if(isset($tier['unit']))
                                    <span class="text-gray-600 text-xs">/ {{ $tier['unit'] }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if(isset($note))
            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                <p class="text-xs text-blue-800">{{ $note }}</p>
            </div>
        @endif
    @endif
</div>
