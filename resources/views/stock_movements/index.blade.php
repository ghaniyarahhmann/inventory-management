
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stock Movement Report
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    {{-- Page Header --}}
                    <div class="mb-8">

                        <h3 class="text-2xl font-bold text-gray-800">
                            Stock Movement Report
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Track all stock coming in and going out of inventory.
                        </p>

                    </div>


                    {{-- Summary Cards --}}
                    <div class="grid grid-cols-1 gap-5 mb-8 sm:grid-cols-2 lg:grid-cols-4">

                        {{-- Total IN Quantity --}}
                        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                            <p class="text-sm font-medium text-slate-500">
                                Total IN Quantity
                            </p>

                            <p class="mt-3 text-2xl font-bold text-green-600">
                                {{ number_format($totalInQuantity, 2) }}
                            </p>

                        </div>


                        {{-- Total OUT Quantity --}}
                        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                            <p class="text-sm font-medium text-slate-500">
                                Total OUT Quantity
                            </p>

                            <p class="mt-3 text-2xl font-bold text-red-600">
                                {{ number_format($totalOutQuantity, 2) }}
                            </p>

                        </div>


                        {{-- Total IN Amount --}}
                        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                            <p class="text-sm font-medium text-slate-500">
                                Total IN Amount
                            </p>

                            <p class="mt-3 text-2xl font-bold text-green-600">
                                ₹{{ number_format($totalInAmount, 2) }}
                            </p>

                        </div>


                        {{-- Total OUT Amount --}}
                        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                            <p class="text-sm font-medium text-slate-500">
                                Total OUT Amount
                            </p>

                            <p class="mt-3 text-2xl font-bold text-red-600">
                                ₹{{ number_format($totalOutAmount, 2) }}
                            </p>

                        </div>

                    </div>


                    {{-- Filters --}}
                    <form
                        method="GET"
                        action="{{ route('stock.report') }}"
                        class="mb-8"
                    >

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5">

                            {{-- Movement Type --}}
                            <div>

                                <label
                                    for="movement_type"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    Movement Type
                                </label>

                                <select
                                    name="movement_type"
                                    id="movement_type"
                                    class="w-full border-gray-300 rounded-md shadow-sm"
                                >

                                    <option value="">
                                        All
                                    </option>

                                    <option
                                        value="IN"
                                        {{ request('movement_type') == 'IN' ? 'selected' : '' }}
                                    >
                                        IN
                                    </option>

                                    <option
                                        value="OUT"
                                        {{ request('movement_type') == 'OUT' ? 'selected' : '' }}
                                    >
                                        OUT
                                    </option>

                                </select>

                            </div>


                            {{-- Product --}}
                            <div>

                                <label
                                    for="product_id"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    Product
                                </label>

                                <select
                                    name="product_id"
                                    id="product_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm"
                                >

                                    <option value="">
                                        All Products
                                    </option>

                                    @foreach($products as $product)

                                        <option
                                            value="{{ $product->id }}"
                                            {{ request('product_id') == $product->id ? 'selected' : '' }}
                                        >
                                            {{ $product->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- From Date --}}
                            <div>

                                <label
                                    for="from_date"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    From Date
                                </label>

                                <input
                                    type="date"
                                    name="from_date"
                                    id="from_date"
                                    value="{{ request('from_date') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm"
                                >

                            </div>


                            {{-- To Date --}}
                            <div>

                                <label
                                    for="to_date"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    To Date
                                </label>

                                <input
                                    type="date"
                                    name="to_date"
                                    id="to_date"
                                    value="{{ request('to_date') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm"
                                >

                            </div>


                            {{-- Department --}}
                            <div>

                                <label
                                    for="department_id"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    Department
                                </label>

                                <select
                                    name="department_id"
                                    id="department_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm"
                                >

                                    <option value="">
                                        All Departments
                                    </option>

                                    @foreach($departments as $department)

                                        <option
                                            value="{{ $department->id }}"
                                            {{ request('department_id') == $department->id ? 'selected' : '' }}
                                        >
                                            {{ $department->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- Buttons --}}
                        <div class="flex items-center gap-3 mt-5">

                            <button
                                type="submit"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md"
                            >
                                Filter
                            </button>

                            <a
                                href="{{ route('stock.report') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded-md"
                            >
                                Clear Filters
                            </a>

                        </div>

                    </form>


                    {{-- Stock Movement Table --}}
                    <div class="overflow-x-auto">

                        <table class="min-w-full border border-gray-300">

                            <thead>

                                <tr class="bg-gray-100">

                                    <th class="border px-4 py-2">
                                        ID
                                    </th>

                                    <th class="border px-4 py-2">
                                        Product
                                    </th>

                                    <th class="border px-4 py-2">
                                        Department
                                    </th>

                                    <th class="border px-4 py-2">
                                        Type
                                    </th>

                                    <th class="border px-4 py-2">
                                        Quantity
                                    </th>

                                    <th class="border px-4 py-2">
                                        Rate
                                    </th>

                                    <th class="border px-4 py-2">
                                        Amount
                                    </th>

                                    <th class="border px-4 py-2">
                                        Unit
                                    </th>

                                    <th class="border px-4 py-2">
                                        Reference
                                    </th>

                                    <th class="border px-4 py-2">
                                        Date
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($movements as $movement)

                                    <tr>

                                        {{-- ID --}}
                                        <td class="border px-4 py-2">
                                            {{ $movement->id }}
                                        </td>


                                       {{-- Product --}}
<td class="border px-4 py-2">

    @if($movement->product)

        <a
            href="{{ route('products.show', $movement->product->id) }}"
            class="text-blue-600 hover:text-blue-800"
        >
            {{ $movement->product->name }}
        </a>

    @else

        N/A

    @endif

</td>


                                        {{-- Department --}}
                                        <td class="border px-4 py-2">
                                            {{ $movement->department->name ?? 'N/A' }}
                                        </td>


                                        {{-- Movement Type --}}
                                        <td class="border px-4 py-2">

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


                                        {{-- Quantity --}}
                                        <td class="border px-4 py-2">
                                            {{ $movement->quantity }}
                                        </td>


                                        {{-- Rate --}}
                                        <td class="border px-4 py-2">
                                            ₹{{ number_format($movement->rate, 2) }}
                                        </td>


                                        {{-- Amount --}}
                                        <td class="border px-4 py-2">
                                            ₹{{ number_format($movement->amount, 2) }}
                                        </td>


                                        {{-- Unit --}}
                                        <td class="border px-4 py-2">
                                            {{ $movement->unit }}
                                        </td>


                                       {{-- Reference --}}
<td class="border px-4 py-2">

    @if($movement->reference_type === 'purchase')

        <a
            href="{{ route('purchases.show', $movement->reference_id) }}"
            class="text-blue-600 hover:text-blue-800"
        >
            Purchase #{{ $movement->reference_id }}
        </a>

    @elseif($movement->reference_type === 'sale')

        <a
            href="{{ route('sales.show', $movement->reference_id) }}"
            class="text-blue-600 hover:text-blue-800"
        >
            Sale #{{ $movement->reference_id }}
        </a>

    @else

        {{ ucfirst($movement->reference_type) }}
        #{{ $movement->reference_id }}

    @endif

</td>


                                        {{-- Date --}}
                                        <td class="border px-4 py-2">
                                            {{ $movement->created_at->format('d-m-Y H:i') }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="10"
                                            class="border px-4 py-4 text-center"
                                        >
                                            No stock movements found.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                                       
{{-- Net Stock Summary --}}
<div class="mt-6 rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200">

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <p class="text-sm font-bold text-slate-800">
            TOTALS:
        </p>

        <p class="text-sm font-semibold text-slate-700">
            <span class="text-green-600">
                +{{ number_format($totalInQuantity, 2) }}
            </span>

            /

            <span class="text-red-600">
                -{{ number_format($totalOutQuantity, 2) }}
            </span>

            <span class="text-slate-500">
                (NET:
            </span>

            <span class="text-slate-900">
                {{ number_format($netQuantity, 2) }}
            </span>

            <span class="text-slate-500">)</span>
        </p>

        <p class="text-sm font-semibold text-slate-700">
            <span class="text-green-600">
                +₹{{ number_format($totalInAmount, 2) }}
            </span>

            /

            <span class="text-red-600">
                -₹{{ number_format($totalOutAmount, 2) }}
            </span>

            <span class="text-slate-500">
                (NET:
            </span>

            <span class="text-slate-900">
                ₹{{ number_format($netAmount, 2) }}
            </span>

            <span class="text-slate-500">)</span>
        </p>

    </div>

</div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
