<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    Sales
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Sales History
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    View all completed sales and their transaction details.
                </p>
            </div>

            <a
                href="{{ route('sales.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                + Create Sale
            </a>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation / Error Messages --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                <p class="mb-2 font-semibold">
                    Please fix the following errors:
                </p>

                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        {{-- Sales Table --}}
        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    {{-- Table Header --}}
                    <thead class="bg-slate-900">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Sale ID
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Product
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Quantity
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Total Amount
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Date
                            </th>

                            @if (
                                auth()->user()->hasPermission('edit_sales') ||
                                auth()->user()->hasPermission('delete_sales')
                            )
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                    Actions
                                </th>
                            @endif

                        </tr>

                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse ($sales as $sale)

                            @foreach ($sale->items as $item)

                                <tr class="transition hover:bg-slate-50">

                                    {{-- Sale ID --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900">

                                        <a
                                            href="{{ route('sales.show', $sale->id) }}"
                                            class="text-blue-600 hover:text-blue-800"
                                        >
                                            #{{ $sale->id }}
                                        </a>

                                    </td>

                                    {{-- Product --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">

                                        <a
                                            href="{{ route('products.show', $item->product->id) }}"
                                            class="text-blue-600 hover:text-blue-800"
                                        >
                                            {{ $item->product->name }}
                                        </a>

                                    </td>

                                    {{-- Quantity --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                        {{ $item->quantity }}
                                    </td>

                                    {{-- Total Amount --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900">
                                       ₹{{ number_format($item->total_amount, 2) }}
                                    </td>

                                    {{-- Date --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                        {{ $sale->created_at->format('d M Y, h:i A') }}
                                    </td>

                                    {{-- Actions --}}
                                    @if (
                                        auth()->user()->hasPermission('edit_sales') ||
                                        auth()->user()->hasPermission('delete_sales')
                                    )

                                        <td class="whitespace-nowrap px-6 py-4 text-sm">

                                            {{-- Edit --}}
                                            @if (auth()->user()->hasPermission('edit_sales'))

                                                <a
                                                    href="{{ route('sales.edit', $sale->id) }}"
                                                    class="font-semibold text-blue-600 hover:text-blue-800"
                                                >
                                                    Edit
                                                </a>

                                            @endif

                                            {{-- Separator --}}
                                            @if (
                                                auth()->user()->hasPermission('edit_sales') &&
                                                auth()->user()->hasPermission('delete_sales')
                                            )

                                                <span class="mx-2 text-slate-300">
                                                    |
                                                </span>

                                            @endif

                                            {{-- Delete --}}
                                            @if (auth()->user()->hasPermission('delete_sales'))

                                                <form
                                                    action="{{ route('sales.destroy', $sale->id) }}"
                                                    method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this sale?');"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="font-semibold text-red-600 hover:text-red-800"
                                                    >
                                                        Delete
                                                    </button>

                                                </form>

                                            @endif

                                        </td>

                                    @endif

                                </tr>

                            @endforeach

                        @empty

                            <tr>

                                <td
                                    colspan="{{ (
                                        auth()->user()->hasPermission('edit_sales') ||
                                        auth()->user()->hasPermission('delete_sales')
                                    ) ? 6 : 5 }}"
                                    class="px-6 py-12 text-center text-sm text-slate-500"
                                >
                                    No sales found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
