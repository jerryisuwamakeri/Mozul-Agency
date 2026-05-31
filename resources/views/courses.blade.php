@extends('layouts.public')
@section('title', 'Courses')
@section('subtitle', 'Digital Marketing Courses')

@section('content')

{{-- Page Header --}}
<section class="relative pt-40 pb-20 bg-[#07070c] overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.015%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">Learn With Us</span>
        <h1 class="text-5xl lg:text-6xl font-black text-white leading-tight mb-6">Courses</h1>
        <p class="text-gray-400 text-lg max-w-2xl leading-relaxed">Practical digital marketing education built for African professionals and businesses ready to grow.</p>
    </div>
</section>

@if($courses->isEmpty())

{{-- ═══════ COMING SOON ═══════ --}}
<section class="py-32 bg-[#0a0a0f] relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-[#07070c] to-[#0a0a0f]"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        {{-- Animated badge --}}
        <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-5 py-2 mb-10">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            <span class="text-white/60 text-sm font-semibold tracking-wide">Currently in development</span>
        </div>

        <h2 class="text-5xl lg:text-7xl font-black text-white leading-none tracking-tight mb-6">
            Coming<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-300 to-white">Soon.</span>
        </h2>

        <p class="text-gray-400 text-xl leading-relaxed max-w-2xl mx-auto mb-12">
            We're building something exceptional. Our courses will cover digital marketing strategy, content creation, paid advertising, brand building, and more — tailored specifically for African markets.
        </p>

        {{-- What to expect --}}
        <div class="grid sm:grid-cols-3 gap-5 mb-14">
            @foreach([
                ['icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z','title'=>'Strategy Courses','desc'=>'Build end-to-end digital marketing strategies for real African businesses'],
                ['icon'=>'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z','title'=>'Content Masterclasses','desc'=>'Learn to create content that actually converts and builds brand authority'],
                ['icon'=>'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z','title'=>'Paid Ads Training','desc'=>'Master Meta and Google Ads with campaigns optimised for African markets'],
            ] as $item)
            <div class="bg-[#13131f] border border-white/5 rounded-2xl p-6 text-left">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                </div>
                <h3 class="text-white font-bold mb-2">{{ $item['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Notify CTA --}}
        <div class="bg-[#13131f] border border-white/10 rounded-3xl p-8 max-w-xl mx-auto">
            <h3 class="text-white font-bold text-xl mb-2">Be the first to know</h3>
            <p class="text-gray-500 text-sm mb-6">Get notified when our first course launches. No spam, ever.</p>
            <a href="{{ route('contact.index') }}"
               class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-black font-bold px-8 py-4 rounded-2xl transition-all hover:-translate-y-0.5">
                Get Early Access
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

@else

{{-- ═══════ COURSES GRID ═══════ --}}
<section class="py-20 bg-[#0a0a0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Stats bar --}}
        @php $published = $courses->where('status','published')->count(); $comingSoon = $courses->where('status','coming_soon')->count(); @endphp
        @if($published || $comingSoon)
        <div class="flex items-center gap-6 mb-10 text-sm text-gray-500">
            @if($published)<span><strong class="text-white font-black">{{ $published }}</strong> course{{ $published != 1 ? 's' : '' }} available</span>@endif
            @if($comingSoon && $published)<span class="text-gray-700">·</span>@endif
            @if($comingSoon)<span><strong class="text-white font-black">{{ $comingSoon }}</strong> coming soon</span>@endif
        </div>
        @endif

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
            <div class="group bg-[#0d0d18] border border-white/5 {{ $course->status === 'coming_soon' ? '' : 'hover:border-white/20 hover:-translate-y-1' }} rounded-2xl overflow-hidden transition-all duration-300 flex flex-col {{ $course->status === 'coming_soon' ? 'opacity-80' : '' }}">

                {{-- Cover --}}
                <div class="aspect-video overflow-hidden bg-white/5 relative">
                    @if($course->cover_image)
                    <img src="{{ Storage::url($course->cover_image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover {{ $course->status === 'coming_soon' ? 'grayscale' : 'group-hover:scale-105 transition-transform duration-500' }}">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center gap-3 bg-gradient-to-br from-white/5 to-transparent">
                        <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    @endif

                    {{-- Coming soon overlay --}}
                    @if($course->status === 'coming_soon')
                    <div class="absolute inset-0 flex items-center justify-center bg-black/50">
                        <span class="bg-white text-black text-xs font-black px-3 py-1.5 rounded-full uppercase tracking-widest">Coming Soon</span>
                    </div>
                    @endif

                    {{-- Level badge --}}
                    @if($course->level)
                    <div class="absolute top-3 left-3">
                        <span class="bg-black/70 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">{{ $course->level_label }}</span>
                    </div>
                    @endif
                </div>

                {{-- Body --}}
                <div class="p-6 flex flex-col flex-1">
                    @if($course->category)
                    <span class="text-white/40 text-[11px] font-bold uppercase tracking-widest mb-2">{{ $course->category }}</span>
                    @endif

                    <h3 class="text-white font-bold text-lg leading-snug mb-3 {{ $course->status !== 'coming_soon' ? 'group-hover:text-gray-300 transition-colors' : '' }}">{{ $course->title }}</h3>

                    @if($course->description)
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-4 flex-1">{{ $course->description }}</p>
                    @else
                    <div class="flex-1"></div>
                    @endif

                    {{-- Meta --}}
                    <div class="flex items-center gap-4 text-xs text-gray-600 mb-5 pt-4 border-t border-white/5">
                        @if($course->duration)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $course->duration }}
                        </span>
                        @endif
                        @if($course->level)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            {{ $course->level_label }}
                        </span>
                        @endif
                    </div>

                    {{-- Price + CTA --}}
                    <div class="flex items-center justify-between">
                        <div>
                            @if($course->is_free)
                            <span class="text-white font-black text-lg">Free</span>
                            @else
                            <span class="text-white font-black text-lg">{{ $course->formatted_price }}</span>
                            @endif
                        </div>

                        @if($course->status === 'coming_soon')
                        <span class="text-gray-600 text-sm font-medium">Coming soon</span>
                        @elseif($course->enrollment_url)
                        <a href="{{ $course->enrollment_url }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1.5 bg-white hover:bg-gray-100 text-black font-bold px-5 py-2.5 rounded-xl text-sm transition-all">
                            Enroll Now
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        @else
                        <a href="{{ route('contact.index') }}"
                           class="inline-flex items-center gap-1.5 bg-white hover:bg-gray-100 text-black font-bold px-5 py-2.5 rounded-xl text-sm transition-all">
                            Get Access
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endif

@endsection
