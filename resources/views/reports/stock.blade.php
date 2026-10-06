<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    Reports
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Stock Report
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                  View current stock, stock received, and stock sold for all products.
                </p>
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                Dashboard
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-900">
                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Product Name
                            </th>


                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Stock In
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Stock Out
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Balance
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Status
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse ($products as $product)

                            <tr class="transition hover:bg-slate-50">

                                {{-- Number --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Product Name --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-700">
                                    {{ $product->name }}
                                </td>

                                {{-- Stock In --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                    {{ $product->purchase_items_sum_quantity ?? 0 }}
                                </td>

                                {{-- Stock Out --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                    {{ $product->sale_items_sum_quantity ?? 0 }}
                                </td>

                                {{-- Balance --}}

                                <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-700">
    {{ $product->stock }}
</td>


                               {{-- Status --}}
<td class="whitespace-nowrap px-6 py-4">

    @if ($product->stock <= 5)

        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
            Low Stock
        </span>

    @else

        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
            In Stock
        </span>

    @endif

</td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">
                                    No products found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>