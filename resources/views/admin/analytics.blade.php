@extends('layouts.admin')
@section('title', 'Analytics')

@section('admin-content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-end justify-between">
        <div>
            <h1 class="text-white font-bold text-lg">Analytics</h1>
            <p class="text-gray-600 text-xs mt-0.5">Last {{ $days }} days · Updated live</p>
        </div>
        <div class="flex items-center gap-1.5 text-[11px] text-gray-600">
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
            Tracking active
        </div>
    </div>

    {{-- Top KPI strip --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 border border-white/5 rounded-2xl overflow-hidden">
        @php $kpis = [
            ['v'=> number_format($totalViews),    'l'=>'Views (30d)',      'sub'=>'Page views'],
            ['v'=> number_format($uniqueVisitors), 'l'=>'Visitors (30d)',  'sub'=>'Unique sessions'],
            ['v'=> number_format($allTimeViews),  'l'=>'All-Time Views',   'sub'=>'Since launch'],
            ['v'=> number_format($totalPosts),    'l'=>'Live Posts',       'sub'=>'Published'],
            ['v'=> number_format($totalSubs),     'l'=>'Submissions',      'sub'=>'All time'],
            ['v'=> number_format($unreadSubs),    'l'=>'Unread',           'sub'=>'Submissions', 'alert'=>$unreadSubs > 0],
        ]; @endphp
        @foreach($kpis as $i => $kpi)
        <div class="px-5 py-4 bg-[#13131f] {{ $i > 0 ? 'border-l border-white/5' : '' }}">
            <div class="text-2xl font-black text-white tabular-nums">{{ $kpi['v'] }}</div>
            <div class="text-white/50 text-xs font-medium mt-1">{{ $kpi['l'] }}
                @if(!empty($kpi['alert']))<span class="ml-1 inline-block w-1.5 h-1.5 rounded-full bg-white align-middle animate-pulse"></span>@endif
            </div>
            <div class="text-gray-700 text-[10px] mt-0.5">{{ $kpi['sub'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Main charts row --}}
    <div class="grid lg:grid-cols-3 gap-5">

        {{-- Page Views Over Time --}}
        <div class="lg:col-span-2 bg-[#13131f] border border-white/5 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-white font-semibold text-sm">Page Views</h2>
                    <p class="text-gray-600 text-xs mt-0.5">Last 30 days</p>
                </div>
                <div class="text-gray-600 text-xs">{{ number_format(array_sum($viewCounts)) }} total</div>
            </div>
            <div class="h-56">
                <canvas id="viewsChart"></canvas>
            </div>
        </div>

        {{-- Content Breakdown Doughnut --}}
        <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5">
            <div class="mb-5">
                <h2 class="text-white font-semibold text-sm">Content Views</h2>
                <p class="text-gray-600 text-xs mt-0.5">By content type</p>
            </div>
            <div class="h-44 flex items-center justify-center">
                <canvas id="contentTypeChart"></canvas>
            </div>
            <div class="mt-4 space-y-2">
                <div class="flex items-center justify-between text-xs">
                    <span class="flex items-center gap-2 text-gray-400"><span class="w-2.5 h-2.5 rounded-sm bg-white inline-block"></span>Blog Posts</span>
                    <span class="text-white font-semibold">{{ number_format($blogViews) }}</span>
                </div>
                <div class="flex items-center justify-between text-xs">
                    <span class="flex items-center gap-2 text-gray-400"><span class="w-2.5 h-2.5 rounded-sm bg-gray-500 inline-block"></span>Courses</span>
                    <span class="text-white font-semibold">{{ number_format($courseViews) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom charts row --}}
    <div class="grid lg:grid-cols-3 gap-5">

        {{-- Visitors by country --}}
        <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5">
            <div class="mb-5">
                <h2 class="text-white font-semibold text-sm">Visitors by Country</h2>
                <p class="text-gray-600 text-xs mt-0.5">Top {{ $byCountry->count() }} countries</p>
            </div>
            @if($byCountry->isEmpty())
            <div class="flex flex-col items-center justify-center py-10 text-center">
                <svg class="w-8 h-8 text-gray-700 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                <p class="text-gray-600 text-xs">No geo data yet.<br>Visit blog posts to populate.</p>
            </div>
            @else
            <div class="space-y-3">
                @php $maxCount = $byCountry->max('count'); @endphp
                @foreach($byCountry as $row)
                <div>
                    <div class="flex items-center justify-between text-xs mb-1">
                        <span class="text-gray-300 truncate pr-2">{{ $row->country }}</span>
                        <span class="text-gray-500 shrink-0">{{ number_format($row->count) }}</span>
                    </div>
                    <div class="h-1.5 bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-white rounded-full transition-all" style="width: {{ $maxCount > 0 ? round(($row->count / $maxCount) * 100) : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Top Posts --}}
        <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5">
            <div class="mb-5">
                <h2 class="text-white font-semibold text-sm">Top Blog Posts</h2>
                <p class="text-gray-600 text-xs mt-0.5">By total views</p>
            </div>
            @if($topPosts->isEmpty())
            <div class="flex flex-col items-center justify-center py-10 text-center">
                <p class="text-gray-600 text-xs">No views recorded yet.</p>
            </div>
            @else
            <div class="h-52">
                <canvas id="topPostsChart"></canvas>
            </div>
            @endif
        </div>

        {{-- Submissions over time --}}
        <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-white font-semibold text-sm">Submissions</h2>
                    <p class="text-gray-600 text-xs mt-0.5">Last 30 days</p>
                </div>
                <div class="text-gray-600 text-xs">{{ number_format(array_sum($subCounts)) }} total</div>
            </div>
            <div class="h-52">
                <canvas id="subsChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Content status row --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            ['label'=>'Published Posts',   'value'=>$publishedPosts,    'of'=>$publishedPosts+$draftPosts,     'color'=>'bg-green-400'],
            ['label'=>'Draft Posts',        'value'=>$draftPosts,        'of'=>$publishedPosts+$draftPosts,     'color'=>'bg-white/30'],
            ['label'=>'Live Courses',       'value'=>$publishedCourses,  'of'=>$publishedCourses+$comingSoonCourses+1,'color'=>'bg-white'],
            ['label'=>'Coming Soon Courses','value'=>$comingSoonCourses, 'of'=>$publishedCourses+$comingSoonCourses+1,'color'=>'bg-white/40'],
        ] as $item)
        <div class="bg-[#13131f] border border-white/5 rounded-xl p-4">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-500 text-xs font-medium">{{ $item['label'] }}</span>
                <span class="text-white font-black text-xl">{{ $item['value'] }}</span>
            </div>
            <div class="h-1 bg-white/5 rounded-full overflow-hidden">
                <div class="{{ $item['color'] }} h-full rounded-full" style="width: {{ $item['of'] > 0 ? min(100, round(($item['value'] / $item['of']) * 100)) : 0 }}%"></div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@push('scripts')
<script>
const chartDefaults = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { display: false }, tooltip: {
        backgroundColor: '#0d0d18',
        borderColor: 'rgba(255,255,255,0.1)',
        borderWidth: 1,
        titleColor: '#fff',
        bodyColor: 'rgba(255,255,255,0.6)',
        padding: 10,
        cornerRadius: 8,
    }},
    scales: {
        x: { grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: 'rgba(255,255,255,0.3)', font: { size: 10 } } },
        y: { grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: 'rgba(255,255,255,0.3)', font: { size: 10 } }, beginAtZero: true },
    }
}

const dates  = @json($viewDates);
const views  = @json($viewCounts);
const subs   = @json($subCounts);

// Views line chart
new Chart(document.getElementById('viewsChart'), {
    type: 'line',
    data: {
        labels: dates,
        datasets: [{
            data: views,
            borderColor: 'rgba(255,255,255,0.8)',
            backgroundColor: 'rgba(255,255,255,0.05)',
            borderWidth: 2,
            fill: true,
            tension: 0.4,
            pointRadius: 0,
            pointHoverRadius: 4,
            pointHoverBackgroundColor: '#fff',
        }]
    },
    options: { ...chartDefaults, plugins: { ...chartDefaults.plugins } }
})

// Content type doughnut
new Chart(document.getElementById('contentTypeChart'), {
    type: 'doughnut',
    data: {
        labels: ['Blog Posts', 'Courses'],
        datasets: [{
            data: [{{ $blogViews }}, {{ $courseViews }}],
            backgroundColor: ['rgba(255,255,255,0.85)', 'rgba(255,255,255,0.25)'],
            borderWidth: 0,
            hoverOffset: 4,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
            legend: { display: false },
            tooltip: chartDefaults.plugins.tooltip,
        }
    }
})

// Top posts horizontal bar
@if($topPosts->isNotEmpty())
new Chart(document.getElementById('topPostsChart'), {
    type: 'bar',
    data: {
        labels: @json($topPosts->pluck('label')),
        datasets: [{
            data: @json($topPosts->pluck('views')),
            backgroundColor: 'rgba(255,255,255,0.12)',
            hoverBackgroundColor: 'rgba(255,255,255,0.25)',
            borderRadius: 4,
            borderSkipped: false,
        }]
    },
    options: {
        ...chartDefaults,
        indexAxis: 'y',
        scales: {
            x: { ...chartDefaults.scales.x, grid: { display: false } },
            y: { ...chartDefaults.scales.y, grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 10 } } },
        }
    }
})
@endif

// Submissions line chart
new Chart(document.getElementById('subsChart'), {
    type: 'bar',
    data: {
        labels: dates,
        datasets: [{
            data: subs,
            backgroundColor: 'rgba(255,255,255,0.15)',
            hoverBackgroundColor: 'rgba(255,255,255,0.3)',
            borderRadius: 3,
            borderSkipped: false,
        }]
    },
    options: { ...chartDefaults }
})
</script>
@endpush
@endsection
