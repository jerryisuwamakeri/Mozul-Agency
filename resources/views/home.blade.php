@extends('layouts.public')
@section('title', \App\Models\Setting::get('site_name', 'Mozul Africa'))
@section('subtitle', 'Creative Digital Marketing Agency')

@section('content')

{{-- HERO --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-[#07070c]">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.015%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white/[0.02] rounded-full blur-[120px] -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-white/[0.02] rounded-full blur-[100px] translate-y-1/3 -translate-x-1/4"></div>
    </div>
    <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7">
                <h1 class="text-5xl sm:text-6xl lg:text-[4.5rem] font-black text-white leading-[1.03] tracking-tight mb-7">
                    {!! $heroHeadlineHtml !!}
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed max-w-xl mb-10">
                    {{ \App\Models\Setting::get('hero_subheadline', 'A creative digital marketing agency helping businesses, founders, and executives across Africa build powerful digital identities through strategy, storytelling, content, and growth marketing.') }}
                </p>
                <div class="flex flex-wrap gap-4 mb-14">
                    <a href="{{ route('contact.index') }}" class="group inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-black font-bold px-7 py-4 rounded-2xl transition-all hover:shadow-xl hover:-translate-y-0.5">
                        {{ \App\Models\Setting::get('hero_cta_primary', 'Book a Discovery Call') }}
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 text-white font-semibold px-7 py-4 rounded-2xl transition-all">
                        {{ \App\Models\Setting::get('hero_cta_secondary', 'View Our Services') }}
                    </a>
                </div>
                <div class="flex flex-wrap gap-x-8 gap-y-4 pt-8 border-t border-white/10">
                    @foreach($stats as $stat)
                    <div>
                        <div class="text-2xl font-black text-white">{{ $stat['value'] }}</div>
                        <div class="text-gray-500 text-xs mt-0.5">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="lg:col-span-5 hidden lg:block">
                <div class="relative">
                    <div class="bg-gradient-to-br from-[#14141f] to-[#0d0d18] border border-white/8 rounded-3xl p-8 space-y-4">
                        <div class="text-white/40 text-xs font-mono mb-6 tracking-wider">// What We Do</div>
                        @foreach(['Digital Marketing Strategy','Social Media Management','Paid Advertising (Meta + Google)','Content Creation & Editorial','Brand Identity & Design','Email Marketing & Automation'] as $i => $svc)
                        <div class="flex items-center gap-3 group">
                            <span class="text-white/30 font-mono text-xs w-6 shrink-0">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
                            <div class="flex-1 h-px bg-white/5 group-hover:bg-white/15 transition-colors"></div>
                            <span class="text-gray-300 text-sm font-medium text-right">{{ $svc }}</span>
                        </div>
                        @endforeach
                        <div class="mt-8 pt-6 border-t border-white/5">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                </div>
                                <span class="text-gray-400 text-sm">Strategy before tactics. Always.</span>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-white text-black text-xs font-black px-4 py-2 rounded-xl shadow-lg shadow-black/20 rotate-3">
                        Created to Create.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MARQUEE --}}
<div class="bg-black py-3 overflow-hidden">
    <div class="flex animate-marquee whitespace-nowrap">
        @php $items = ['Digital Strategy', 'Brand Identity', 'Social Media', 'Paid Advertising', 'Content Creation', 'Email Marketing', 'Legacy Branding', 'Growth Marketing', 'SEO & Analytics', 'Campaign Management']; @endphp
        @for($i=0;$i<3;$i++)
            @foreach($items as $item)
            <span class="inline-flex items-center gap-3 mx-4 text-white font-bold text-sm">
                <span class="w-1.5 h-1.5 bg-white/40 rounded-full"></span>{{ $item }}
            </span>
            @endforeach
        @endfor
    </div>
</div>

{{-- ABOUT --}}
<section class="py-28 bg-[#0a0a0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div>
                <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">About Mozul Africa</span>
                <h2 class="text-4xl lg:text-5xl font-black text-white leading-tight mb-8">
                    Built for African Brands<br><em class="not-italic text-gray-300">Ready to Grow</em>
                </h2>
                <div class="space-y-5 text-gray-400 leading-relaxed">
                    <p>In today's digital economy, visibility alone is not enough. Brands need strategy, clarity, and consistent execution to stand out and stay relevant.</p>
                    <p>At Mozul Africa, we combine creative storytelling with data-driven marketing to help businesses attract the right audience, strengthen their brand presence, and achieve measurable growth.</p>
                    <p>From startups and SMEs to established organisations and senior executives, we create digital systems that turn attention into trust — and trust into business results.</p>
                </div>
                <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 mt-8 text-white font-semibold hover:gap-4 transition-all group">
                    Start your growth journey
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach($stats as $stat)
                <div class="group bg-[#13131f] border border-white/5 hover:border-white/20 rounded-2xl p-7 transition-all hover:-translate-y-1 duration-300 cursor-default">
                    <div class="text-4xl lg:text-5xl font-black text-white mb-3 group-hover:scale-110 transition-transform origin-left">{{ $stat['value'] }}</div>
                    <div class="text-gray-400 text-sm leading-snug">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- HOW WE WORK --}}
<section class="py-28 bg-[#07070c]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5">Our Approach</span>
            <h2 class="text-4xl lg:text-5xl font-black text-white mb-4">How We Work</h2>
            <p class="text-gray-400 max-w-xl mx-auto">A clear, repeatable process that takes you from where you are to where you want to be.</p>
        </div>
        @php $steps = [
            ['num'=>'01','title'=>'Discover','desc'=>'We deep-dive into your business, goals, audience, and competitive landscape to understand what makes you different and what needs to change.','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
            ['num'=>'02','title'=>'Strategise','desc'=>'We build a tailored digital marketing plan with clear priorities, timelines, and measurable milestones — no generic templates.','icon'=>'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
            ['num'=>'03','title'=>'Execute','desc'=>'We bring the strategy to life — with precision, creativity, and consistency across every channel and every deliverable.','icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
            ['num'=>'04','title'=>'Grow','desc'=>'We track performance, optimise continuously, and scale what\'s working — so your results compound over time.','icon'=>'M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ]; @endphp
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($steps as $step)
            <div class="group bg-[#0d0d18] border border-white/5 hover:border-white/20 rounded-2xl p-8 transition-all duration-300 hover:-translate-y-1 h-full">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-white/10 group-hover:bg-white/15 rounded-xl flex items-center justify-center transition-colors shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/></svg>
                    </div>
                    <span class="text-white/20 font-mono font-black text-2xl">{{ $step['num'] }}</span>
                </div>
                <h3 class="text-white font-bold text-xl mb-3">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SERVICES SNAPSHOT --}}
<section class="py-28 bg-[#0a0a0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div>
                <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">What We Offer</span>
                <h2 class="text-4xl lg:text-5xl font-black text-white">Our Core Services</h2>
            </div>
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-white font-semibold hover:gap-4 transition-all group shrink-0">
                View All Services
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        @php $featuredServices = [
            ['icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z','title'=>'Digital Marketing Strategy','desc'=>'Clarity before campaigns. We build the roadmap before we run the race.'],
            ['icon'=>'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z','title'=>'Social Media Management','desc'=>'Consistent content, engaged communities, and measurable brand growth.'],
            ['icon'=>'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z','title'=>'Paid Advertising','desc'=>'Meta & Google campaigns optimised for maximum return on your ad spend.'],
            ['icon'=>'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z','title'=>'Content Creation','desc'=>'Words, scripts, and stories that build authority and drive action.'],
            ['icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z','title'=>'Brand Identity & Design','desc'=>'Logos, guidelines, and visual systems that make your brand unforgettable.'],
            ['icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z','title'=>'Email Marketing & Automation','desc'=>'Turn your email list into your most reliable revenue channel.'],
        ]; @endphp
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($featuredServices as $svc)
            <a href="{{ route('services.index') }}" class="group bg-[#0d0d18] border border-white/5 hover:border-white/20 rounded-2xl p-5 sm:p-7 transition-all duration-300 hover:-translate-y-1 flex flex-col">
                <div class="w-10 h-10 bg-white/10 group-hover:bg-white/15 rounded-xl flex items-center justify-center mb-4 transition-colors shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $svc['icon'] }}"/></svg>
                </div>
                <h3 class="text-white font-bold text-base sm:text-lg mb-2 group-hover:text-gray-300 transition-colors">{{ $svc['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed flex-1">{{ $svc['desc'] }}</p>
                <div class="mt-4 flex items-center gap-1.5 text-white/40 group-hover:text-white/80 transition-colors text-xs font-semibold uppercase tracking-wider">
                    Learn more <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="py-28 bg-[#07070c]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5">Client Stories</span>
            <h2 class="text-4xl lg:text-5xl font-black text-white mb-4">What Our Clients Say</h2>
            <p class="text-gray-400 max-w-xl mx-auto">Real results from real businesses across Africa.</p>
        </div>
        @php
        $testimonials = $reviews->count() ? $reviews->map(fn($r) => [
            'name'    => $r->name,
            'role'    => ($r->position ? $r->position.', ' : '') . ($r->company ?? ''),
            'content' => $r->content,
            'rating'  => $r->rating,
            'initial' => strtoupper(substr($r->name, 0, 1)),
        ])->toArray() : [
            ['name'=>'Adaeze Nwosu','role'=>'Founder, LuminaBeauty Lagos','content'=>'Mozul Africa completely transformed our social media presence. In three months we went from inconsistent posts to a brand that people actually follow and engage with. Our sales from Instagram grew by over 200%.','rating'=>5,'initial'=>'A'],
            ['name'=>'Emeka Okonkwo','role'=>'CEO, TrustFinance Nigeria','content'=>'The strategy they built for us was exactly what we needed. They took time to understand our industry before making any recommendations — and the results speak for themselves. Our digital leads doubled within six months.','rating'=>5,'initial'=>'E'],
            ['name'=>'Fatima Sule','role'=>'Managing Director, Sule Properties','content'=>'I was sceptical about digital marketing for real estate, but Mozul Africa showed us the way. Their content and paid ad strategy generated more qualified leads in two months than we had seen all year.','rating'=>5,'initial'=>'F'],
            ['name'=>'Chukwuemeka Eze','role'=>'Executive Director, NovaTech Solutions','content'=>'Professional, responsive, and genuinely invested in our success. They don\'t just deliver work — they explain the why behind every decision. That transparency builds real trust.','rating'=>5,'initial'=>'C'],
            ['name'=>'Bisi Adeleke','role'=>'Head of Marketing, Adeleke Group','content'=>'The brand identity they designed for our rebrand was stunning. They captured our values and vision perfectly. Every stakeholder who has seen it has been impressed.','rating'=>5,'initial'=>'B'],
            ['name'=>'Dr. Ngozi Okafor','role'=>'Consultant & Speaker','content'=>'The Legacy Branding Programme was exactly what I needed to build my personal brand online. Within weeks of launching, I started getting speaking invitations and media mentions I had never received before.','rating'=>5,'initial'=>'N'],
        ];
        @endphp
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($testimonials as $t)
            <div class="bg-[#0d0d18] border border-white/5 hover:border-white/15 rounded-2xl p-5 sm:p-7 flex flex-col transition-colors group">
                <div class="flex gap-1 mb-4">
                    @for($s=1;$s<=5;$s++)
                    <svg class="w-4 h-4 {{ $s<=$t['rating'] ? 'text-white' : 'text-gray-700' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <div class="text-3xl text-white/10 font-serif leading-none mb-2 group-hover:text-white/20 transition-colors">"</div>
                <p class="text-gray-300 text-sm leading-relaxed flex-1 mb-5">{{ $t['content'] }}</p>
                <div class="flex items-center gap-3 pt-4 border-t border-white/5 min-w-0">
                    <div class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center text-white font-black text-sm shrink-0">{{ $t['initial'] }}</div>
                    <div class="min-w-0">
                        <div class="text-white font-semibold text-sm truncate">{{ $t['name'] }}</div>
                        @if($t['role'])<div class="text-gray-500 text-xs truncate">{{ $t['role'] }}</div>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BLOG PREVIEW --}}
@if($latestPosts->count())
<section class="py-28 bg-[#0a0a0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">Insights</span>
                <h2 class="text-4xl font-black text-white">Latest from Our Blog</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="hidden md:inline-flex items-center gap-2 text-white font-semibold text-sm hover:gap-4 transition-all group">
                All Posts <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($latestPosts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="group bg-[#0d0d18] border border-white/5 hover:border-white/20 rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1 flex flex-col">
                <div class="aspect-video overflow-hidden bg-white/5">
                    @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-1">
                    @if($post->category)<span class="text-white text-xs font-bold uppercase tracking-wide">{{ $post->category->name }}</span>@endif
                    <h3 class="text-white font-bold text-lg mt-2 mb-3 group-hover:text-gray-300 transition-colors line-clamp-2 flex-1">{{ $post->title }}</h3>
                    @if($post->excerpt)<p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $post->excerpt }}</p>@endif
                    <div class="flex items-center justify-between text-xs text-gray-600 pt-4 border-t border-white/5 mt-auto">
                        <span>{{ $post->published_at?->format('M j, Y') }}</span>
                        <span>{{ $post->reading_time }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA BANNER --}}
<section class="py-24 bg-black relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.03%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl lg:text-5xl font-black text-white mb-5 leading-tight">
            Your Brand Deserves to Be<br>Seen, Heard, and Remembered.
        </h2>
        <p class="text-white/60 text-lg mb-10 max-w-2xl mx-auto">
            Stop leaving growth on the table. Let's build a digital strategy that actually works for your business.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 bg-white text-black font-bold px-8 py-4 rounded-2xl hover:bg-gray-100 transition-all hover:-translate-y-0.5 hover:shadow-xl">
                Book a Free Discovery Call
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-8 py-4 rounded-2xl transition-all">
                Explore Services
            </a>
        </div>
    </div>
</section>

@endsection
