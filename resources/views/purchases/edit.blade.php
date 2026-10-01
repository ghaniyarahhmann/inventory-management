<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white">
                    Edit Purchase
                </h2>

                <p class="mt-1 text-sm text-slate-400">
                    Update the purchase details.
                </p>
            </div>

            <div class="overflow-hidden rounded-lg bg-slate-900 shadow-xl">
                <div class="p-6">

                    <form method="POST"
                          action="{{ route('purchases.update', $purchase) }}">

                        @csrf
                        @method('PUT')

                        @php
                            $item = $purchase->items->first();
                        @endphp

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-white">
                                Product
                            </label>

                            <select name="product_id"
                                    class="mt-1 block w-full rounded-md border-slate-700 bg-slate-800 text-white">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ $item && $item->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-white">
                                Quantity
                            </label>

                            <input type="number"
                                   name="quantity"
                                   min="1"
                                   value="{{ $item?->quantity }}"
                                   class="mt-1 block w-full rounded-md border-slate-700 bg-slate-800 text-white">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-white">
                                Unit Purchase Price
                            </label>

                            <input type="number"
                                   name="price"
                                   step="0.01"
                                   min="0"
                                   value="{{ $item?->price }}"
                                   class="mt-1 block w-full rounded-md border-slate-700 bg-slate-800 text-white">
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                Update Purchase
                            </button>

                            <a href="{{ route('purchases.index') }}"
                               class="rounded-md bg-slate-700 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>