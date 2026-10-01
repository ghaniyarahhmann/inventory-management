<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                Overview
            </p>

            <h1 class="mt-1 text-3xl font-bold text-slate-900">
                Inventory Dashboard
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Here's what's happening with your inventory and sales activity.
            </p>
        </div>


        {{-- Main Statistics --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Products --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between p-6">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Products
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $totalProducts }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            Products in catalog
                        </p>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m0 0L4 7m8 4v10"/>
                        </svg>
                    </div>

                </div>

                <div class="h-1 bg-blue-500"></div>
            </div>


            {{-- Stock --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between p-6">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Stock
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $totalStock }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            Units currently available
                        </p>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 12h14M12 5v14"/>
                        </svg>
                    </div>

                </div>

                <div class="h-1 bg-emerald-500"></div>
            </div>


            {{-- Purchases --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between p-6">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Purchases
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $totalPurchases }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            Purchase transactions
                        </p>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 4h12m-9 4a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                    </div>

                </div>

                <div class="h-1 bg-orange-500"></div>
            </div>


            {{-- Sales --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between p-6">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Sales
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $totalSales }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            Sales transactions
                        </p>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-purple-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10V6m0 12v-2m9-4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                </div>

                <div class="h-1 bg-purple-500"></div>
            </div>

        </div>


        {{-- Financial Summary --}}
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Purchase Amount --}}
            <div class="rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 p-6 text-white shadow-lg">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-orange-100">
                            Total Purchase Amount
                        </p>

                        <p class="mt-3 text-3xl font-bold">
                            ₹{{ number_format($totalPurchaseAmount, 2) }}
                        </p>

                        <p class="mt-2 text-sm text-orange-100">
                            Amount spent on purchases
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/20 p-4">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10V6m0 12v-2m9-4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                </div>

            </div>


            {{-- Sales Amount --}}
            <div class="rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 p-6 text-white shadow-lg">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-emerald-100">
                            Total Sales Amount
                        </p>

                        <p class="mt-3 text-3xl font-bold">
                            ₹{{ number_format($totalSaleAmount, 2) }}
                        </p>

                        <p class="mt-2 text-sm text-emerald-100">
                            Revenue generated from sales
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/20 p-4">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10V6m0 12v-2m9-4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                </div>

            </div>

        </div>


        {{-- Low Stock --}}
        @if($lowStockProducts->count() > 0)

            <div class="mt-8 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-red-200">

                <div class="border-b border-red-100 bg-red-50 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-semibold text-red-800">
                                Low Stock Alert
                            </h2>

                            <p class="text-sm text-red-600">
                                These products need attention.
                            </p>
                        </div>

                    </div>

                </div>

                <div class="divide-y divide-slate-100">

                    @foreach($lowStockProducts as $product)

                        <div class="flex items-center justify-between px-6 py-4">

                            <div>
                                <p class="font-medium text-slate-900">
                                    {{ $product->name }}
                                </p>

                                <p class="text-sm text-slate-500">
                                    Current stock
                                </p>
                            </div>

                            <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                {{ $product->stock }} units
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>

       @endif


{{-- Stock Overview --}}
<div class="mt-8 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

    <div>
        <h2 class="font-semibold text-slate-900">
            Stock Overview
        </h2>

        <p class="text-sm text-slate-500">
            Products with the lowest current stock.
        </p>
    </div>

    <a href="{{ route('products.index') }}"
       class="text-sm font-medium text-blue-600 hover:text-blue-800">
        View Products →
    </a>

</div>
    <div class="divide-y divide-slate-100">

        @foreach($stockOverview as $product)

            <div class="flex items-center justify-between px-6 py-4">

                <div>
                    <p class="font-medium text-slate-900">
                        {{ $product->name }}
                    </p>

                    <p class="text-sm text-slate-500">
                        Current stock
                    </p>
                </div>

                <span class="text-sm font-semibold text-slate-700">
                    {{ $product->stock }} units
                </span>

            </div>

        @endforeach

    </div>

</div>


{{-- Quick Actions --}}
<div class="mt-8">
            <h2 class="text-lg font-bold text-slate-900">
                Quick Actions
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Frequently used inventory actions.
            </p>

            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                @if(auth()->user()->hasPermission('create_products'))
                    <a href="{{ route('products.create') }}"
                       class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-md">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                            +
                        </div>

                        <h3 class="mt-4 font-semibold text-slate-900">
                            Add Product
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Add a new product to inventory.
                        </p>
                    </a>
                @endif


                @if(auth()->user()->hasPermission('create_sales'))
                    <a href="{{ route('sales.create') }}"
                       class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-md">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                            $
                        </div>

                        <h3 class="mt-4 font-semibold text-slate-900">
                            New Sale
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Record a new sale.
                        </p>
                    </a>
                @endif


                @if(auth()->user()->hasPermission('create_purchases'))
                    <a href="{{ route('purchases.create') }}"
                       class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-md">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                            +
                        </div>

                        <h3 class="mt-4 font-semibold text-slate-900">
                            New Purchase
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Record incoming stock.
                        </p>
                    </a>
                @endif


                <a href="{{ route('stock.report') }}"
                   class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-600">
                        ↗
                    </div>

                    <h3 class="mt-4 font-semibold text-slate-900">
                        Stock Report
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        View current stock details.
                    </p>
                </a>

            </div>

        </div>

    </div>

</x-app-layout>