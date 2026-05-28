<x-layouts.app>

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Newsletter Subscribers</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Manage your newsletter subscriber list</p>
            </div>
            <div class="flex gap-3">
                <x-button type="success" tag="a" href="{{ route('admin.newsletters.export') }}" icon="fas-download">
                    Export CSV
                </x-button>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-forms.input label="Search Email" name="search" type="text"
                            placeholder="Search by email..." value="{{ request('search') }}" />
                    </div>

                    <div>
                        <x-forms.select label="Status" name="status" :options="['1' => 'Subscribed', '0' => 'Unsubscribed']" placeholder="All Statuses"
                            :selected="request('status')" />
                    </div>

                    <div class="flex items-end gap-2">
                        <x-button type="primary" buttonType="submit" icon="fas-search" class="flex-1">
                            Search
                        </x-button>
                        <x-button type="secondary" tag="a" href="{{ route('admin.newsletters.index') }}">
                            Clear
                        </x-button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Email
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Status
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                Subscribed At</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                        @forelse ($newsletters as $newsletter)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('admin.newsletters.show', $newsletter) }}"
                                        class="text-purple-600 hover:text-purple-700 font-medium">
                                        {{ $newsletter->email }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($newsletter->is_subscribed)
                                        <span
                                            class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs font-semibold">
                                            Subscribed
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-full text-xs font-semibold">
                                            Unsubscribed
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $newsletter->subscribed_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    <x-button type="info" tag="a"
                                        href="{{ route('admin.newsletters.show', $newsletter) }}" icon="fas-eye" />
                                    <form action="{{ route('admin.newsletters.destroy', $newsletter) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="danger" buttonType="submit" icon="fas-trash" />
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-inbox text-3xl mb-2 block"></i>
                                    No newsletter subscribers found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($newsletters->hasPages())
            <div class="mt-6">
                {{ $newsletters->links() }}
            </div>
        @endif

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Subscribers</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">
                            {{ \App\Models\Newsletter::count() }}</p>
                    </div>
                    <div class="text-4xl text-purple-200">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Active Subscriptions</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">
                            {{ \App\Models\Newsletter::where('is_subscribed', true)->count() }}</p>
                    </div>
                    <div class="text-4xl text-green-200">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Unsubscribed</p>
                        <p class="text-3xl font-bold text-red-600 mt-1">
                            {{ \App\Models\Newsletter::where('is_subscribed', false)->count() }}</p>
                    </div>
                    <div class="text-4xl text-red-200">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
