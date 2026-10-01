<x-app-layout>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    Purchase
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Purchase #{{ $purchase->id }}
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    View details of this purchase transaction.
                </p>
            </div>

            {{-- Purchase Summary --}}
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">

                {{-- Purchase ID --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-medium text-slate-500">
                        Purchase ID
                    </p>

                    <p class="mt-2 text-xl font-semibold text-slate-900">
                        #{{ $purchase->id }}
                    </p>
                </div>

                {{-- Purchase Date --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-medium text-slate-500">
                        Date
                    </p>

                    <p class="mt-2 text-xl font-semibold text-slate-900">
                        {{ $purchase->created_at->format('d-m-Y H:i') }}
                    </p>
                </div>

                {{-- Total --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-medium text-slate-500">
                        Total Amount
                    </p>

                    <p class="mt-2 text-xl font-semibold text-green-600">
                        ₹{{ number_format(
                            $purchase->items->sum(function ($item) {
                                return $item->quantity * $item->price;
                            }),
                            2
                        ) }}
                    </p>
                </div>

            </div>

            {{-- Purchase Items --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-semibold text-slate-900">
                        Purchase Items
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Products included in this purchase.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-sm">

                        <thead class="bg-slate-50">
                            <tr>
                                <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                    Product
                                </th>

                                <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                    Quantity
                                </th>

                                <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                    Price
                                </th>

                                <th class="border px-4 py-3 text-left font-semibold text-slate-700">
                                    Total
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($purchase->items as $item)

                                <tr class="hover:bg-slate-50">

                                    <td class="border px-4 py-3">
                                        {{ $item->product->name ?? 'N/A' }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $item->quantity }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        ₹{{ number_format($item->price, 2) }}
                                    </td>

                                    <td class="border px-4 py-3 font-semibold">
                                        ₹{{ number_format($item->quantity * $item->price, 2) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4"
                                        class="border px-4 py-8 text-center text-slate-500">
                                        No items found for this purchase.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

            {{-- Back Button --}}
            <div class="mt-6">

                <a href="{{ route('purchases.index') }}"
                   class="inline-flex items-center rounded-xl bg-slate-800 px-5 py-3 text-sm font-medium text-white transition hover:bg-slate-700">
                    ← Back to Purchases
                </a>

            </div>

        </div>
    </div>

</x-app-layout>