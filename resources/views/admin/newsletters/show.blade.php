<x-layouts.app>

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $newsletter->email }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Newsletter Subscriber Details</p>
            </div>
            <div class="flex gap-3">
                <x-button type="secondary" tag="a" href="{{ route('admin.newsletters.index') }}" icon="fas-arrow-left">
                    Back
                </x-button>
                <form action="{{ route('admin.newsletters.destroy', $newsletter) }}" method="POST" class="inline-block"
                    onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <x-button type="danger" buttonType="submit" icon="fas-trash">
                        Delete
                    </x-button>
                </form>
            </div>
        </div>

        <!-- Details Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8">
            <div class="space-y-6">
                <!-- Email -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Email Address</label>
                    <p class="text-lg font-medium text-gray-900 dark:text-white mt-2">{{ $newsletter->email }}</p>
                </div>

                <!-- Subscription Status -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Subscription Status</label>
                    <div class="mt-2">
                        @if ($newsletter->is_subscribed)
                            <span
                                class="px-4 py-2 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg font-semibold inline-block">
                                <i class="fas-check-circle mr-2"></i> Actively Subscribed
                            </span>
                        @else
                            <span
                                class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-lg font-semibold inline-block">
                                <i class="fas-times-circle mr-2"></i> Unsubscribed
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Subscription Timeline -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Subscribed At</label>
                        <p class="text-gray-900 dark:text-white mt-2">
                            {{ $newsletter->subscribed_at->format('F d, Y') }}
                            <span class="text-gray-600 dark:text-gray-400 text-sm">@
                                {{ $newsletter->subscribed_at->format('H:i A') }}</span>
                        </p>
                    </div>

                    @if ($newsletter->unsubscribed_at)
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Unsubscribed
                                At</label>
                            <p class="text-gray-900 dark:text-white mt-2">
                                {{ $newsletter->unsubscribed_at->format('F d, Y') }}
                                <span class="text-gray-600 dark:text-gray-400 text-sm">@
                                    {{ $newsletter->unsubscribed_at->format('H:i A') }}</span>
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Subscription Duration -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Subscription Duration</label>
                    <p class="text-gray-900 dark:text-white mt-2">
                        @if ($newsletter->is_subscribed)
                            {{ $newsletter->subscribed_at->diffForHumans() }} (Active for
                            {{ $newsletter->subscribed_at->diffInDays(now()) }} days)
                        @else
                            Subscribed for
                            {{ $newsletter->subscribed_at->diffInDays($newsletter->unsubscribed_at ?? now()) }} days
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
