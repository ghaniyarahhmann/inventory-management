<nav class="fixed left-0 top-0 z-50 h-screen w-64 bg-slate-950 text-white shadow-2xl">

    {{-- Logo --}}
    <div class="flex h-20 items-center border-b border-slate-800 px-6">
        <div>
            <h1 class="text-xl font-bold tracking-wide text-white">
                Inventory
            </h1>

            <p class="text-xs text-slate-400">
                Management System
            </p>
        </div>
    </div>

    {{-- Current User --}}
    <div class="border-b border-slate-800 px-4 py-4">

        <a
            href="{{ route('profile.edit') }}"
            class="flex items-center gap-3 rounded-xl bg-slate-900 px-4 py-3 transition hover:bg-slate-800"
        >

            {{-- User Initial --}}
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            {{-- User Information --}}
            <div class="min-w-0">

                <p class="truncate text-sm font-semibold text-white">
                    {{ auth()->user()->name }}
                </p>

                {{-- Multiple Roles --}}
                <p class="text-xs text-blue-400">
                    @if (auth()->user()->roles->isNotEmpty())
                        {{ auth()->user()->roles->pluck('name')->join(', ') }}
                    @else
                        No Role
                    @endif
                </p>

            </div>

        </a>

    </div>

    {{-- Navigation --}}
    <div class="flex h-[calc(100vh-12rem)] min-h-0 flex-col">

        {{-- Scrollable Navigation --}}
        <div class="flex-1 overflow-y-auto px-4 py-6">

            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/30'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6"
                    />
                </svg>

                Dashboard

            </a>


            {{-- Products --}}
            @if (auth()->user()->hasPermission('view_products'))

                <div class="pt-4">

                    <p class="px-4 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Inventory
                    </p>

                    <a
                        href="{{ route('products.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('products.index')
                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/30'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m0 0L4 7m8 4v10"
                            />
                        </svg>

                        Products

                    </a>


                    {{-- Add Product --}}
                    @if (auth()->user()->hasPermission('create_products'))

                        <a
                            href="{{ route('products.create') }}"
                            class="ml-8 mt-1 flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-slate-400 transition hover:text-white"
                        >

                            <span class="h-1.5 w-1.5 rounded-full bg-blue-400"></span>

                            Add Product

                        </a>

                    @endif

                </div>

            @endif


            {{-- Sales --}}
            @if (auth()->user()->hasPermission('view_sales'))

                <div class="pt-5">

                    <p class="px-4 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Sales
                    </p>

                    <a
                        href="{{ route('sales.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('sales.index')
                            ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/30'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 10h18M7 15h1m3 0h1m-5 4h10a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>

                        Sales History

                    </a>


                    {{-- New Sale --}}
                    @if (auth()->user()->hasPermission('create_sales'))

                        <a
                            href="{{ route('sales.create') }}"
                            class="ml-8 mt-1 flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-slate-400 transition hover:text-white"
                        >

                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                            New Sale

                        </a>

                    @endif

                </div>

            @endif


            {{-- Purchases --}}
            @if (auth()->user()->hasPermission('view_purchases'))

                <div class="pt-5">

                    <p class="px-4 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Purchases
                    </p>

                    <a
                        href="{{ route('purchases.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('purchases.index')
                            ? 'bg-orange-500 text-white shadow-lg shadow-orange-900/30'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 4h12m-9 4a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"
                            />
                        </svg>

                        Purchase History

                    </a>


                    {{-- New Purchase --}}
                    @if (auth()->user()->hasPermission('create_purchases'))

                        <a
                            href="{{ route('purchases.create') }}"
                            class="ml-8 mt-1 flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-slate-400 transition hover:text-white"
                        >

                            <span class="h-1.5 w-1.5 rounded-full bg-orange-400"></span>

                            New Purchase

                        </a>

                    @endif

                </div>

            @endif


            {{-- Reports --}}
            <div class="pt-5">

                <p class="px-4 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                    Reports
                </p>


                {{-- Stock Report --}}
                <a
                    href="{{ route('reports.stock') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('reports.stock')
                        ? 'bg-purple-600 text-white shadow-lg shadow-purple-900/30'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v10a2 2 0 01-2 2z"
                        />
                    </svg>

                    Stock Report

                </a>


                {{-- Stock Movement Report --}}
                <a
                    href="{{ route('stock.report') }}"
                    class="mt-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs('stock.report')
                        ? 'bg-purple-600 text-white shadow-lg shadow-purple-900/30'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    Stock Movement Report

                </a>

            </div>


            {{-- Administration --}}
            @if (auth()->user()->hasPermission('view_users'))

                <div class="mt-5 border-t border-slate-800 pt-5">

                    <p class="px-4 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Administration
                    </p>


                    {{-- Users --}}
                    <a
                        href="{{ route('users.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('users.*')
                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/30'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                            />
                        </svg>

                        Users

                    </a>


                    {{-- Roles --}}
                    <a
                        href="{{ route('roles.index') }}"
                        class="mt-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('roles.*')
                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/30'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 12a4 4 0 100-8 4 4 0 000 8zm-7 9a7 7 0 0114 0"
                            />
                        </svg>

                        Roles

                    </a>


                    {{-- Departments --}}
                    <a
                        href="{{ route('departments.index') }}"
                        class="mt-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('departments.*')
                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/30'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h6M9 11h6M9 15h6"
                            />
                        </svg>

                        Departments

                    </a>

                </div>

            @endif

        </div>


        {{-- User section --}}
        <div class="shrink-0 border-t border-slate-800 bg-slate-950 p-4">

            {{-- Profile --}}
            <a
                href="{{ route('profile.edit') }}"
                class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
            >

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                </svg>

                Profile

            </a>


            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm text-red-400 transition hover:bg-red-500/10 hover:text-red-300"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 013-3h4a3 3 0 013 3v1"
                        />
                    </svg>

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>


<script>
    const sidebar = document.querySelector('nav .overflow-y-auto');

    if (sidebar) {

        const savedScroll = sessionStorage.getItem('sidebarScroll');

        if (savedScroll !== null) {
            sidebar.scrollTop = parseInt(savedScroll, 10);
        }

        sidebar.addEventListener('scroll', function () {
            sessionStorage.setItem(
                'sidebarScroll',
                sidebar.scrollTop
            );
        });

        sidebar.querySelectorAll('a').forEach(function (link) {

            link.addEventListener('click', function () {

                sessionStorage.setItem(
                    'sidebarScroll',
                    sidebar.scrollTop
                );

            });

        });

    }
</script>