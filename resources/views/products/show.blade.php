<x-app-layout>
<div class="py-8">

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-8">

            <h1 class="text-2xl font-bold text-slate-900">
                {{ $product->name }}
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Stock movement history for this product.
            </p>

        </div>

       {{-- Product Summary --}}
<div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">

    {{-- Product --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm font-medium text-slate-500">
            Product
        </p>

        <p class="mt-2 text-xl font-semibold text-slate-900">
            {{ $product->name }}
        </p>
    </div>

    {{-- Current Stock --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm font-medium text-slate-500">
            Current Stock
        </p>

        <p class="mt-2 text-xl font-semibold text-slate-900">
            {{ $product->stock }} units
        </p>
    </div>

    {{-- Price --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm font-medium text-slate-500">
            Price
        </p>

        <p class="mt-2 text-xl font-semibold text-slate-900">
            ₹{{ number_format($product->price, 2) }}
        </p>
    </div>

    {{-- Total IN --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm font-medium text-slate-500">
            Total IN
        </p>

        <p class="mt-2 text-xl font-semibold text-green-600">
            {{ $totalInQuantity }} units
        </p>
    </div>

    {{-- Total OUT --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm font-medium text-slate-500">
            Total OUT
        </p>

        <p class="mt-2 text-xl font-semibold text-red-600">
            {{ $totalOutQuantity }} units
        </p>
    </div>

    {{-- Total IN Amount --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm font-medium text-slate-500">
            Total IN Amount
        </p>

        <p class="mt-2 text-xl font-semibold text-green-600">
            ₹{{ number_format($totalInAmount, 2) }}
        </p>
    </div>

    {{-- Total OUT Amount --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm font-medium text-slate-500">
            Total OUT Amount
        </p>

        <p class="mt-2 text-xl font-semibold text-red-600">
            ₹{{ number_format($totalOutAmount, 2) }}
        </p>
    </div>

</div>
        {{-- Stock Movement History --}}
        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

            <div class="border-b border-slate-100 px-6 py-5">

                <h2 class="font-semibold text-slate-900">
                    Stock Movement History
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    All stock coming in and going out for this product.
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full border-collapse text-sm">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                ID
                            </th>

                            <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                Department
                            </th>

                            <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                Type
                            </th>

                            <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                Quantity
                            </th>

                            <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                Rate
                            </th>

                            <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                Amount
                            </th>

                            <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                Reference
                            </th>

                            <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                Date
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($movements as $movement)

                            <tr class="hover:bg-slate-50">

                                <td class="border px-4 py-3">
                                    {{ $movement->id }}
                                </td>

                                <td class="border px-4 py-3">
                                    {{ $movement->department->name ?? 'N/A' }}
                                </td>

                                <td class="border px-4 py-3">

                                    @if($movement->movement_type == 'IN')

                                        <span class="font-semibold text-green-600">
                                            IN
                                        </span>

                                    @elseif($movement->movement_type == 'OUT')

                                        <span class="font-semibold text-red-600">
                                            OUT
                                        </span>

                                    @else

                                        {{ $movement->movement_type }}

                                    @endif

                                </td>

                                <td class="border px-4 py-3">
                                    {{ $movement->quantity }}
                                </td>

                                <td class="border px-4 py-3">
                                    ₹{{ number_format($movement->rate, 2) }}
                                </td>

                                <td class="border px-4 py-3">
                                    ₹{{ number_format($movement->amount, 2) }}
                                </td>

                                <td class="border px-4 py-3">

    @if($movement->reference_type === 'purchase')

        <a href="{{ route('purchases.show', $movement->reference_id) }}"
           class="font-medium text-blue-600 hover:text-blue-800">
            Purchase #{{ $movement->reference_id }}
        </a>

    @elseif($movement->reference_type === 'sale')

        <a href="{{ route('sales.show', $movement->reference_id) }}"
           class="font-medium text-blue-600 hover:text-blue-800">
            Sale #{{ $movement->reference_id }}
        </a>

    @else

        {{ ucfirst($movement->reference_type) }}
        #{{ $movement->reference_id }}

    @endif

</td>
                                <td class="border px-4 py-3">
                                    {{ $movement->created_at->format('d-m-Y H:i') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="border px-4 py-8 text-center text-slate-500">
                                    No stock movements found for this product.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Back Button --}}
        <div class="mt-6">

            <a href="{{ route('products.index') }}"
               class="inline-flex items-center rounded-xl bg-slate-800 px-5 py-3 text-sm font-medium text-white transition hover:bg-slate-700">
                ← Back to Products
            </a>

        </div>

    </div>

</div>

</x-app-layout>