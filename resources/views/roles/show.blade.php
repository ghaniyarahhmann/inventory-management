<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    Access Control
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Role Details
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    View the role and its assigned permissions.
                </p>
            </div>

            <a
                href="{{ route('roles.index') }}"
                class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
            >
                ← Back to Roles
            </a>

        </div>


        {{-- Role Details Card --}}
        <div class="max-w-3xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            {{-- Role Information --}}
            <div class="mb-8">

                <p class="text-sm font-medium text-slate-500">
                    Role
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-900">
                    {{ $role->name }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Role ID: #{{ $role->id }}
                </p>

            </div>


            {{-- Permissions --}}
            <div class="mb-8">

                <h3 class="mb-4 text-sm font-semibold text-slate-700">
                    Assigned Permissions
                </h3>

                @if ($role->permissions->count())

                    <div class="grid gap-3 sm:grid-cols-2">

                        @foreach ($role->permissions as $permission)

                            <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">

                                <p class="text-sm font-medium text-slate-700">
                                    {{ $permission->name }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-500">
                        This role has no permissions assigned.
                    </div>

                @endif

            </div>


            {{-- Actions --}}
            <div class="flex items-center gap-3">

                <a
                    href="{{ route('roles.edit', $role->id) }}"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    Edit Role
                </a>

                <a
                    href="{{ route('roles.index') }}"
                    class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                >
                    Back
                </a>

            </div>

        </div>

    </div>

</x-app-layout>