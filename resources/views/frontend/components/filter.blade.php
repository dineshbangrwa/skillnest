<aside id="sidebar-filters"
    class="hidden md:block w-full md:w-56 shrink-0 border border-gray-200 rounded p-5 bg-white md:sticky md:top-20" <h3
    class="font-sora font-bold text-sm text-gray-900 mb-1">Filters</h3>
    <p class="text-xs text-gray-500 mb-5">Refine your results</p>

    <form action="{{ route('courses.search') }}" method="get" id="filter-form">
        <input type="hidden" name="query" value="{{ request()->query('query') }}">
        <input type="hidden" name="category" value="{{ request()->query('category') }}">
        {{-- <input type="hidden" name="subcategory" value="{{ request()->query('subcategory') }}"> --}}
        {{-- Ratings --}}
        <div class="mb-6">
            <h4 class="font-bold text-xs text-gray-700 uppercase tracking-wider mb-3">Ratings</h4>
            @php
                $selectedRating = request()->query('rating', []);

                if (!is_array($selectedRating)) {
                    $selectedRating = [$selectedRating];
                }
            @endphp

            @foreach ([5, 4, 3, 2, 1] as $rating)
                <label class="flex items-center gap-2.5 cursor-pointer mb-2 group">
                    <input type="checkbox" name="rating[]" class="accent-purple-600 w-4 h-4 shrink-0"
                        value="{{ $rating }}" {{ in_array($rating, $selectedRating) ? 'checked' : '' }}
                        onchange="document.getElementById('filter-form').submit()">
                    <span class="text-amber-400 text-xs">★★★★★</span>
                    <span
                        class="text-sm text-gray-600 group-hover:text-purple-600 transition">{{ $rating }}</span>
                </label>
            @endforeach
        </div>

        <div class="border-t border-gray-100 mb-5"></div>

        {{-- Duration --}}
        <div class="mb-6">
            <h4 class="font-bold text-xs text-gray-700 uppercase tracking-wider mb-3">Duration</h4>

            @php
                $selectedDurations = request()->query('duration', []);

                if (!is_array($selectedDurations)) {
                    $selectedDurations = [$selectedDurations];
                }

                $selectedDurations = request()->query('duration', []);
                if (!is_array($selectedDurations)) {
                    $selectedDurations = [$selectedDurations];
                }

                $ranges = [
                    '0-5' => '0-5 Hours',
                    '5-15' => '5 – 15 Hours',
                    '15-25' => '15 – 25 Hours',
                    '25-35' => '25 – 35 Hours',
                    '35-50' => '35-50+ Hours',
                ];
            @endphp

            @foreach ($ranges as $key => $label)
                <label class="flex items-center gap-2.5 cursor-pointer mb-2">
                    <input type="checkbox" name="duration[]" value="{{ $key }}"
                        class="accent-purple-600 w-4 h-4 shrink-0"
                        {{ in_array($key, $selectedDurations) ? 'checked' : '' }}
                        onchange="document.getElementById('filter-form').submit()">

                    <span class="text-sm text-gray-600 hover:text-purple-600 transition">
                        {{ $label }}
                    </span>
                </label>
            @endforeach
        </div>

        <div class="border-t border-gray-100 mb-5"></div>

        {{-- Level --}}
        <div class="mb-6">
            <h4 class="font-bold text-xs text-gray-700 uppercase tracking-wider mb-3">Level</h4>
            @php
                $selectedLevels = request()->query('level', []);

                if (!is_array($selectedLevels)) {
                    $selectedLevels = [$selectedLevels];
                }
            @endphp

            @foreach (App\Models\Course::LEVEL_OPTIONS as $key => $value)
                <label class="flex items-center gap-2.5 cursor-pointer mb-2">
                    <input type="checkbox" name="level[]" value="{{ $key }}"
                        class="accent-purple-600 w-4 h-4 shrink-0"
                        {{ in_array($key, $selectedLevels) ? 'checked' : '' }}
                        onchange="document.getElementById('filter-form').submit()">

                    <span class="text-sm text-gray-600 hover:text-purple-600 transition">
                        {{ $value }}
                    </span>
                </label>
            @endforeach
        </div>

        {{-- <div class="border-t border-gray-100 mb-5"></div> --}}

        {{-- Language --}}
        {{-- <div>
            <h4 class="font-bold text-xs text-gray-700 uppercase tracking-wider mb-3">Language</h4>
            @foreach (['English', 'Hindi', 'Urdu', 'Spanish', 'French'] as $lang)
                <label class="flex items-center gap-2.5 cursor-pointer mb-2">
                    <input type="checkbox" class="accent-purple-600 w-4 h-4 shrink-0">
                    <span class="text-sm text-gray-600 hover:text-purple-600 transition">{{ $lang }}</span>
                </label>
            @endforeach
        </div> --}}
    </form>
</aside>

{{-- MOBILE FILTERS PANEL --}}
<div id="mobile-filters"
    class="hidden md:hidden w-full border border-gray-200 rounded p-5 mb-5 bg-white transition-all duration-300">

    <form action="{{ route('courses.search') }}" method="get" id="mobile-filter-form">
        {{-- Hidden inputs --}}
        <input type="hidden" name="query" value="{{ request()->query('query') }}">
        <input type="hidden" name="category" value="{{ request()->query('category') }}">
        <input type="hidden" name="subcategory" value="{{ request()->query('subcategory') }}">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            {{-- Ratings --}}
            <div>
                <h4 class="font-bold text-xs text-gray-700 uppercase tracking-wider mb-3">Ratings</h4>
                @foreach ([5, 4, 3, 2, 1] as $rating)
                    <label class="flex items-center gap-2 cursor-pointer mb-2">
                        <input type="checkbox" name="rating[]"
                            class="accent-purple-600 w-4 h-4 shrink-0"
                            value="{{ $rating }}"
                            {{ in_array($rating, $selectedRating) ? 'checked' : '' }}
                            onchange="document.getElementById('mobile-filter-form').submit()">
                        <span class="text-amber-400 text-xs">★★★★★</span>
                        <span class="text-sm text-gray-600">{{ $rating }}</span>
                    </label>
                @endforeach
            </div>

            {{-- Level --}}
            <div>
                <h4 class="font-bold text-xs text-gray-700 uppercase tracking-wider mb-3">Level</h4>
                @foreach (App\Models\Course::LEVEL_OPTIONS as $key => $value)
                    <label class="flex items-center gap-2 cursor-pointer mb-2">
                        <input type="checkbox" name="level[]" value="{{ $key }}"
                            class="accent-purple-600 w-4 h-4 shrink-0"
                            {{ in_array($key, $selectedLevels) ? 'checked' : '' }}
                            onchange="document.getElementById('mobile-filter-form').submit()">
                        <span class="text-sm text-gray-600">{{ $value }}</span>
                    </label>
                @endforeach
            </div>

            {{-- Duration --}}
            <div>
                <h4 class="font-bold text-xs text-gray-700 uppercase tracking-wider mb-3">Duration</h4>
                @foreach ($ranges as $key => $label)
                    <label class="flex items-center gap-2 cursor-pointer mb-2">
                        <input type="checkbox" name="duration[]" value="{{ $key }}"
                            class="accent-purple-600 w-4 h-4 shrink-0"
                            {{ in_array($key, $selectedDurations) ? 'checked' : '' }}
                            onchange="document.getElementById('mobile-filter-form').submit()">
                        <span class="text-sm text-gray-600">{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        function toggleFilters() {
            const panel = document.getElementById('mobile-filters');
            const chevron = document.getElementById('filter-chevron');
            const isHidden = panel.classList.toggle('hidden');
            chevron.className = isHidden ? 'fa fa-chevron-down text-gray-400' : 'fa fa-chevron-up text-purple-500';
        }
    </script>
@endpush
