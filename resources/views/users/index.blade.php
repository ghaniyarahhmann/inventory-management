<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    User Management
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Users
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Manage users, roles, and departments.
                </p>
            </div>

            <a
                href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                + Add User
            </a>

        </div>

        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="border-b border-slate-200 bg-slate-50">

                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                ID
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Name
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Email
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Role
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Department
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($users as $user)

                            <tr class="transition hover:bg-slate-50">

                                <td class="px-6 py-4 text-sm font-medium text-slate-700">
                                    #{{ $user->id }}
                                </td>

                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                                    {{ $user->name }}
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">
@if ($user->roles->isNotEmpty())
    {{ $user->roles->pluck('name')->join(', ') }}
@else
    No Role
@endif

                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $user->department?->name ?? 'No Department' }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex justify-end gap-3">

                                        <a
                                            href="{{ route('users.show', $user->id) }}"
                                            class="text-sm font-semibold text-blue-600 hover:text-blue-800"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('users.edit', $user->id) }}"
                                            class="text-sm font-semibold text-slate-600 hover:text-slate-900"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('users.destroy', $user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-sm font-semibold text-red-600 hover:text-red-800"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center text-sm text-slate-500"
                                >
                                    No users found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>