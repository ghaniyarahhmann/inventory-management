<x-guest-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-10">

        <div class="mx-auto flex min-h-[80vh] max-w-md items-center justify-center">

            <div class="w-full">

                {{-- Branding --}}
                <div class="mb-8 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-2xl font-bold text-white shadow-sm">
                        IM
                    </div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Inventory Management
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Sign in to manage your inventory
                    </p>
                </div>

                {{-- Login Card --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

                    {{-- Session Status --}}
                    <x-auth-session-status
                        class="mb-5"
                        :status="session('status')"
                    />

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                            <p class="mb-2 font-semibold">
                                Please check your login details.
                            </p>

                            <ul class="list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                placeholder="Enter your email"
                            >

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Password --}}
                        <div class="mt-5">
                            <label
                                for="password"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Password
                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                placeholder="Enter your password"
                            >

                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Remember Me / Forgot Password --}}
                        <div class="mt-5 flex items-center justify-between gap-4">

                            <label class="inline-flex items-center">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                >

                                <span class="ms-2 text-sm text-slate-600">
                                    Remember me
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-sm font-semibold text-blue-600 transition hover:text-blue-700"
                                >
                                    Forgot password?
                                </a>
                            @endif

                        </div>

                        {{-- Login Button --}}
                        <button
                            type="submit"
                            class="mt-7 w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                            Log in
                        </button>

                    </form>

                </div>

                <p class="mt-6 text-center text-xs text-slate-400">
                    Inventory Management System
                </p>

            </div>

        </div>

    </div>

</x-guest-layout>