<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                User Management
            </p>

            <h1 class="mt-1 text-3xl font-bold text-slate-900">
                User Details
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                View the user's account, roles, and department information.
            </p>
        </div>

        <div class="max-w-3xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            <div class="space-y-6">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                        User ID
                    </p>

                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        #{{ $user->id }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Name
                    </p>

                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        {{ $user->name }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Email
                    </p>

                    <p class="mt-1 text-lg text-slate-700">
                        {{ $user->email }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Roles
                    </p>

                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        @if ($user->roles->isNotEmpty())
    {{ $user->roles->pluck('name')->join(', ') }}
@else
    No Role
@endif
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Department
                    </p>

                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        {{ $user->department?->name ?? 'No Department' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Email Verified
                    </p>

                    <p class="mt-1 text-lg font-semibold text-slate-900">
                        {{ $user->email_verified_at ? 'Yes' : 'No' }}
                    </p>
                </div>

            </div>

            <div class="mt-8 flex items-center gap-3">

                <a
                    href="{{ route('users.edit', $user->id) }}"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    Edit User
                </a>

                <a
                    href="{{ route('users.index') }}"
                    class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                >
                    Back
                </a>

            </div>

        </div>

    </div>

</x-app-layout>