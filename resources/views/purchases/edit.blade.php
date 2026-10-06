<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                Purchases
            </p>

            <h1 class="mt-1 text-3xl font-bold text-slate-900">
                Edit Purchase
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Update the purchase details and inventory.
            </p>
        </div>

        {{-- Form Card --}}
        <div class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            {{-- Validation Errors --}}
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

            @php
                $item = $purchase->items->first();
            @endphp

            <form action="{{ route('purchases.update', $purchase) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- Product --}}
                <div class="mb-6">

                    <label
                        for="product_id"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Product
                    </label>

                    <select
                        name="product_id"
                        id="product_id"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        @foreach ($products as $product)

                            <option
                                value="{{ $product->id }}"
                                data-price="{{ $product->price }}"
                                @selected(old('product_id', $item?->product_id) == $product->id)
                            >
                                {{ $product->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Quantity --}}
                <div class="mb-6">

                    <label
                        for="quantity"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Quantity
                    </label>

                    <input
                        type="number"
                        name="quantity"
                        id="quantity"
                        min="1"
                        value="{{ old('quantity', $item?->quantity) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>

                {{-- Unit Purchase Price --}}
                <div class="mb-6">

                    <label
                        for="price"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Unit Purchase Price
                    </label>

                    <input
                        type="number"
                        name="price"
                        id="price"
                        step="0.01"
                        min="0"
                        value="{{ old('price', $item?->price) }}"
                        readonly
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 outline-none"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Unit purchase price is calculated automatically from the total amount and quantity.
                    </p>

                </div>

                {{-- Total Amount --}}
                <div class="mb-8">

                    <label
                        for="total_amount"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Total Amount
                    </label>

                    <input
                        type="number"
                        name="total_amount"
                        id="total_amount"
                        step="0.01"
                        min="0"
                        value="{{ old('total_amount', ($item?->quantity ?? 0) * ($item?->price ?? 0)) }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Enter the total purchase amount. The unit purchase price will be calculated automatically.
                    </p>

                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3">

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                    >
                        Update Purchase
                    </button>

                    <a
                        href="{{ route('purchases.index') }}"
                        class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

    {{-- Price Calculation --}}
    <script>

    const quantityInput = document.getElementById('quantity');
    const priceInput = document.getElementById('price');
    const totalAmountInput = document.getElementById('total_amount');

    function updateTotalAmount() {

        const quantity = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;

        totalAmountInput.value = (quantity * price).toFixed(2);
    }

    // Quantity changed
    quantityInput.addEventListener('input', updateTotalAmount);

    // Initial calculation
    updateTotalAmount();

</script>
</x-app-layout>