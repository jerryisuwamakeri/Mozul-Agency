@extends('layouts.public')
@section('title', 'Why Mozul Africa')
@section('subtitle', 'Why Choose Us')

@section('content')

<section class="relative pt-40 pb-20 bg-[#07070c] overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.015%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">Why Choose Us</span>
        <h1 class="text-5xl lg:text-6xl font-black text-white leading-tight mb-6">Why Mozul Africa</h1>
        <p class="text-gray-400 text-lg max-w-2xl leading-relaxed">We don't just execute campaigns — we build digital systems that create lasting competitive advantage for your brand.</p>
    </div>
</section>

<section class="py-20 bg-[#0a0a0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php $reasons = [
            ['title'=>'Strategy Before Tactics','desc'=>'We build a clear digital strategy before executing any campaigns — ensuring every action ties back to your business goals.','icon'=>'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
            ['title'=>'Built for the African Market','desc'=>'We understand African audiences, contexts, and platforms — giving your brand an edge that generic agencies miss.','icon'=>'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064'],
            ['title'=>'Premium Quality, Accessible','desc'=>'Enterprise-level thinking delivered in an approachable, collaborative, and transparent way.','icon'=>'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
            ['title'=>'Measurable Growth','desc'=>'Every campaign is tied to metrics that matter. You will always know what your investment is returning.','icon'=>'M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ['title'=>'Creative + Commercial','desc'=>'We balance bold creative ideas with sound commercial logic — beauty and performance, together.','icon'=>'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'],
            ['title'=>'Trusted Across Industries','desc'=>'From fintech to lifestyle brands — we have delivered results across multiple sectors and business types.','icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
        ]; @endphp
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reasons as $r)
            <div class="group bg-[#0d0d18] border border-white/5 hover:border-white/20 rounded-2xl p-8 transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 bg-white/10 group-hover:bg-white/15 rounded-2xl flex items-center justify-center mb-6 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $r['icon'] }}"/></svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-3">{{ $r['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $r['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-[#07070c]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-black text-white mb-5">Ready to Work Together?</h2>
        <p class="text-gray-400 mb-8 leading-relaxed">Let's talk about your goals and build a digital strategy that delivers real results.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-black font-bold px-8 py-4 rounded-2xl transition-all hover:-translate-y-0.5">
                Book a Discovery Call
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 text-white font-semibold px-8 py-4 rounded-2xl transition-all">
                View Our Services
            </a>
        </div>
    </div>
</section>

@endsection
