<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    Inventory
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Products
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Manage your products, prices, and stock levels.
                </p>
            </div>

            @if (auth()->user()->hasPermission('create_products'))
                <a
                    href="{{ route('products.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    + Create Product
                </a>
            @endif

        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- Error Message --}}
        @if (session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                {{ session('error') }}
            </div>
        @endif


        {{-- Products Table --}}
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
                                Selling Price
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Stock
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Stock Status
                            </th>

                            @if (
    auth()->user()->hasPermission('view_products') ||
    auth()->user()->hasPermission('edit_products') ||
    auth()->user()->hasPermission('delete_products')
)
    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
        Actions
    </th>
@endif
                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse ($products as $product)

                            <tr class="transition hover:bg-slate-50">

                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900">
                                    {{ $product->name }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                    ₹{{ number_format($product->price, 2) }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-700">
                                    {{ $product->stock }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
@php
    $balance = $product->stock;
@endphp

@if ($balance == 0)

    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
        Out of Stock
    </span>

@elseif ($balance <= 5)

    <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
        Low Stock
    </span>

@else

    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
        In Stock
    </span>

@endif
                                </td>


                                @if (
    auth()->user()->hasPermission('view_products') ||
    auth()->user()->hasPermission('edit_products') ||
    auth()->user()->hasPermission('delete_products')
)

                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-2">

    @if (auth()->user()->hasPermission('view_products'))

        <a
            href="{{ route('products.show', $product) }}"
            class="rounded-lg bg-slate-800 px-3 py-2 text-xs font-semibold text-white transition hover:bg-slate-700"
        >
            View
        </a>

    @endif

    @if (auth()->user()->hasPermission('edit_products'))
                                                <a
                                                    href="{{ route('products.edit', $product) }}"
                                                    class="rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-blue-700"
                                                >
                                                    Edit
                                                </a>

                                            @endif


                                            @if (auth()->user()->hasPermission('delete_products'))

                                                <form
                                                    action="{{ route('products.destroy', $product) }}"
                                                    method="POST"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100"
                                                    >
                                                        Delete
                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                @endif

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center text-sm text-slate-500"
                                >
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