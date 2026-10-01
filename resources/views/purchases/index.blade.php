<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    Purchases
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Purchase History
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    View all purchases and their transaction details.
                </p>
            </div>

            <a
                href="{{ route('purchases.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                + Create Purchase
            </a>

        </div>


        {{-- Purchases Table --}}
        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-900">
                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Purchase ID
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

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-white">
                                Actions
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse ($purchases as $purchase)

                            @foreach ($purchase->items as $item)

                                <tr class="transition hover:bg-slate-50">

                                    {{-- Purchase ID --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900">
                                        <a
                                            href="{{ route('purchases.show', $purchase->id) }}"
                                            class="text-blue-600 hover:text-blue-800"
                                        >
                                            #{{ $purchase->id }}
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
                                        ₹{{ number_format($item->quantity * $item->price, 2) }}
                                    </td>


                                    {{-- Date --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                        {{ $purchase->created_at->format('d M Y, h:i A') }}
                                    </td>


                                    {{-- Actions --}}
<td class="whitespace-nowrap px-6 py-4 text-sm">

    @if(auth()->user()->hasPermission('edit_purchases'))

        <a
            href="{{ route('purchases.edit', $purchase) }}"
            class="mr-3 text-blue-600 hover:text-blue-800"
        >
            Edit
        </a>

    @endif

    @if(auth()->user()->hasPermission('delete_purchases'))

        <form
            method="POST"
            action="{{ route('purchases.destroy', $purchase) }}"
            class="inline"
            onsubmit="return confirm('Are you sure you want to delete this purchase?');"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="text-red-600 hover:text-red-800"
            >
                Delete
            </button>

        </form>

    @endif

</td>
                                </tr>

                            @endforeach

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center text-sm text-slate-500"
                                >
                                    No purchases found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>