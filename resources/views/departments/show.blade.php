
<x-app-layout>

    <div class="min-h-screen bg-slate-100 px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    Departments
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Department Details
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    View department information.
                </p>
            </div>

            <a
                href="{{ route('departments.index') }}"
                class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
            >
                ← Back to Departments
            </a>

        </div>


        {{-- Department Details Card --}}
        <div class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">

            <div class="mb-6">
                <p class="text-sm font-medium text-slate-500">
                    Department ID
                </p>

                <p class="mt-1 text-lg font-semibold text-slate-900">
                    #{{ $department->id }}
                </p>
            </div>


            <div class="mb-8">
                <p class="text-sm font-medium text-slate-500">
                    Department Name
                </p>

                <p class="mt-1 text-2xl font-bold text-slate-900">
                    {{ $department->name }}
                </p>
            </div>


            {{-- Actions --}}
            <div class="flex items-center gap-3">

                <a
                    href="{{ route('departments.edit', $department->id) }}"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    Edit Department
                </a>

                <a
                    href="{{ route('departments.index') }}"
                    class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                >
                    Back
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
