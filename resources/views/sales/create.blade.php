<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                Sales
            </p>

            <h1 class="mt-1 text-3xl font-bold text-slate-900">
                Create Sale
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Record a new sale and update your inventory.
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


            <form action="{{ route('sales.store') }}" method="POST">

                @csrf

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
                                @selected(old('product_id') == $product->id)
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
                        value="{{ old('quantity', 1) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>


                {{-- Unit Selling Price --}}
                <div class="mb-8">

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
                        value="{{ old('price') }}"
                        readonly
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 outline-none"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Selling price per unit. The total amount will be calculated from the quantity.
                    </p>

                    <p class="mt-4 text-lg font-semibold text-slate-900">
                        Total Amount:
                        ₹<span id="totalAmount">0.00</span>
                    </p>

                </div>


                {{-- Buttons --}}
                <div class="flex items-center gap-3">

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                    >
                        Save Sale
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
        const totalAmount = document.getElementById('totalAmount');

        function calculateTotalPrice() {

            const selectedProduct =
                productSelect.options[productSelect.selectedIndex];

            const unitPrice =
                parseFloat(selectedProduct.dataset.price) || 0;

            const quantity =
                parseInt(quantityInput.value) || 0;

            priceInput.value = unitPrice.toFixed(2);

            totalAmount.textContent =
                (unitPrice * quantity).toFixed(2);
        }

        productSelect.addEventListener('change', calculateTotalPrice);
        quantityInput.addEventListener('input', calculateTotalPrice);

        calculateTotalPrice();

    </script>

</x-app-layout>
