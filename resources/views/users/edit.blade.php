<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                User Management
            </p>

            <h1 class="mt-1 text-3xl font-bold text-slate-900">
                Edit User
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Update the user's account, roles, and department.
            </p>
        </div>

        <div class="max-w-3xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

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

            <form
                action="{{ route('users.update', $user) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <!-- Name -->

                <div class="mb-6">

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Enter user name"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>

                <!-- Email -->

                <div class="mb-6">

                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Enter email address"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>

                <!-- Password -->

                <div class="mb-6">

                    <label
                        for="password"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Leave blank to keep current password"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Leave this field blank if you do not want to change the password.
                    </p>

                </div>

                

                <!-- Roles -->

<div class="mb-6">

    <label class="mb-3 block text-sm font-semibold text-slate-700">
        Roles
    </label>

    <div class="grid gap-3 sm:grid-cols-2">

        @foreach ($roles as $role)

            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 transition hover:bg-slate-100">

                <input
                    type="checkbox"
                    name="role_ids[]"
                    value="{{ $role->id }}"
                    {{ in_array(
                        $role->id,
                        old('role_ids', $user->roles->pluck('id')->toArray())
                    ) ? 'checked' : '' }}
                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                >

                <span class="text-sm font-medium text-slate-700">
                    {{ $role->name }}
                </span>

            </label>

        @endforeach

    </div>

    <p class="mt-2 text-xs text-slate-500">
        Select one or more roles.
    </p>

</div>

                <!-- Department -->

                <div class="mb-8">

                    <label
                        for="department_id"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Department
                    </label>

                    <select
                        name="department_id"
                        id="department_id"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option value="">
                            No Department
                        </option>

                        @foreach ($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}
                            >
                                {{ $department->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Buttons -->

                <div class="flex items-center gap-3">

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                    >
                        Update User
                    </button>

                    <a
                        href="{{ route('users.index') }}"
                        class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>