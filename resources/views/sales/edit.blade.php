<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                Sales
            </p>

            <h1 class="mt-1 text-3xl font-bold text-slate-900">
                Edit Sale
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Update the sale details and inventory.
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
                $item = $sale->items->first();
            @endphp

            <form action="{{ route('sales.update', $sale) }}" method="POST">

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

                {{-- Unit Selling Price --}}
                <div class="mb-6">

                    <label
                        for="price"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Unit Selling Price
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
                        Unit selling price comes from the selected product and cannot be edited.
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
                       value="{{ old('total_amount', $item?->total_amount ?? (($item?->quantity ?? 0) * ($item?->price ?? 0))) }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Total amount is calculated from quantity × unit price by default, but you can adjust it manually.
                    </p>

                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3">

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                    >
                        Update Sale
                    </button>

                    <a
                        href="{{ route('sales.index') }}"
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

    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const priceInput = document.getElementById('price');
    const totalAmountInput = document.getElementById('total_amount');

    let totalManuallyEdited = false;

    function getProductPrice() {

        const selectedProduct =
            productSelect.options[productSelect.selectedIndex];

        return parseFloat(selectedProduct.dataset.price) || 0;
    }

    function updatePriceAndTotal() {

        const unitPrice = getProductPrice();
        const quantity = parseFloat(quantityInput.value) || 0;

        priceInput.value = unitPrice.toFixed(2);

        if (!totalManuallyEdited) {
            totalAmountInput.value =
                (unitPrice * quantity).toFixed(2);
        }
    }

    // Product changed
    productSelect.addEventListener('change', function () {

        totalManuallyEdited = false;

        updatePriceAndTotal();
    });

    // Quantity changed
    quantityInput.addEventListener('input', function () {

        if (!totalManuallyEdited) {

            const unitPrice =
                parseFloat(priceInput.value) || 0;

            const quantity =
                parseFloat(quantityInput.value) || 0;

            totalAmountInput.value =
                (unitPrice * quantity).toFixed(2);
        }
    });

    // Total manually changed
    totalAmountInput.addEventListener('input', function () {

        totalManuallyEdited = true;
    });

    // Initial product price
    const initialPrice = getProductPrice();

    priceInput.value = initialPrice.toFixed(2);

</script>
</x-app-layout>