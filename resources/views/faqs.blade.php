@extends('layouts.public')
@section('title', 'FAQs')
@section('subtitle', 'Frequently Asked Questions')

@section('content')

<section class="relative pt-40 pb-20 bg-[#07070c] overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.015%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">Got Questions?</span>
        <h1 class="text-5xl lg:text-6xl font-black text-white leading-tight mb-6">Frequently Asked<br><span class="text-gray-300">Questions</span></h1>
        <p class="text-gray-400 text-lg max-w-2xl leading-relaxed">Everything you need to know about working with Mozul Africa. Can't find your answer? <a href="{{ route('contact.index') }}" class="text-white hover:underline">Send us a message.</a></p>
    </div>
</section>

@php
$categories = [
    ['title'=>'Getting Started','faqs'=>[
        ['q'=>'How do I get started with Mozul Africa?','a'=>'Getting started is simple. Reach out via our contact page, send us an email, or call us directly. We\'ll schedule a free discovery call to understand your business, goals, and challenges. From there, we\'ll recommend the right services and put together a proposal tailored to your needs.'],
        ['q'=>'What types of businesses do you work with?','a'=>'We work with a wide range of clients — from startups and growing SMEs to established corporations and senior executives across Africa. Our services are designed to be flexible enough to serve businesses at different stages, in industries including fintech, retail, healthcare, hospitality, professional services, and more.'],
        ['q'=>'Do you work with personal brands and executives?','a'=>'Absolutely. Through our Legacy Branding Programme, we specifically help CEOs, executives, consultants, and public figures build and amplify their personal digital presence. We help translate decades of experience into thought leadership, speaking visibility, and lasting online influence.'],
        ['q'=>'Do you work with international clients outside Africa?','a'=>'Yes. While our expertise is rooted in the African market, we work with clients globally — including African diaspora businesses and international brands looking to enter African markets. All our engagements are managed remotely with regular video calls and digital reporting.'],
    ]],
    ['title'=>'Services & Process','faqs'=>[
        ['q'=>'Can you handle everything, or do I need my own team?','a'=>'We are a full-service agency — meaning we handle strategy, execution, and reporting. You don\'t need an in-house marketing team. That said, we work just as well as an extension of your existing team if you prefer a collaborative model. We adapt to your situation.'],
        ['q'=>'How long does it take to see results?','a'=>'It depends on the service. Paid advertising can show results within the first 2–4 weeks. Social media management and content creation typically take 2–3 months to build consistent momentum. Brand strategy and identity projects are delivered within 3–6 weeks. We set clear timelines and expectations from the start so you always know what to expect.'],
        ['q'=>'Do you create content yourselves or outsource it?','a'=>'All content is created in-house by our team of strategists, copywriters, and creative directors. We do not outsource your work. Every piece of content goes through an internal quality review before it reaches you for approval.'],
        ['q'=>'How involved do I need to be in the process?','a'=>'We handle the heavy lifting, but your involvement is important — especially at the start. We\'ll need your input during the discovery and briefing phase, and we\'ll seek your approval before publishing anything. After that, the day-to-day execution is on us. Most clients spend 1–2 hours per month reviewing our work.'],
    ]],
    ['title'=>'Pricing & Contracts','faqs'=>[
        ['q'=>'How is your pricing structured?','a'=>'Our pricing depends on the scope of services selected. We offer project-based pricing for one-time work (like brand identity or strategy development) and monthly retainers for ongoing services (like social media management, content creation, or paid advertising management). We provide transparent proposals with no hidden fees.'],
        ['q'=>'Do you require long-term contracts?','a'=>'For project-based work, no long-term contract is required. For ongoing retainer services, we typically work on 3-month minimum engagements — this gives us enough time to build momentum and demonstrate real results. After the initial term, engagements continue on a rolling monthly basis with 30 days\' notice to end.'],
        ['q'=>'Can I start with just one service and scale up?','a'=>'Yes, absolutely. Many clients start with a single service — often a strategy session or social media management — and gradually add more services as they see results and build trust in our work. We make it easy to scale your engagement with us as your business grows.'],
    ]],
    ['title'=>'Results & Reporting','faqs'=>[
        ['q'=>'How do you measure success?','a'=>'We define success metrics at the start of every engagement, tied directly to your business goals. These may include website traffic, lead generation, social media engagement, ad ROAS (return on ad spend), email open rates, or brand visibility metrics. We track these consistently and report on them every month.'],
        ['q'=>'How often will I receive reports?','a'=>'We provide monthly performance reports for all ongoing retainer services, and weekly ad spend summaries for active paid advertising campaigns. You\'ll always have a clear picture of what\'s working, what we\'re optimising, and what comes next.'],
        ['q'=>'Can you guarantee results?','a'=>'No ethical agency can guarantee specific results — marketing involves too many variables, including audience behaviour, market conditions, and competitive dynamics. What we do guarantee is strategic thinking, creative quality, consistent execution, and transparent reporting. We have a strong track record of delivering measurable growth for our clients.'],
    ]],
];
@endphp

<section class="py-20 bg-[#0a0a0f]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ open: null }" class="space-y-16">
            @foreach($categories as $ci => $category)
            <div>
                <h2 class="text-2xl font-black text-white mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 bg-white/10 rounded-xl flex items-center justify-center text-white font-black text-sm">{{ $ci + 1 }}</span>
                    {{ $category['title'] }}
                </h2>
                <div class="space-y-3">
                    @foreach($category['faqs'] as $fi => $faq)
                    @php $key = $ci . '-' . $fi; @endphp
                    <div class="bg-[#0d0d18] border border-white/5 rounded-2xl overflow-hidden">
                        <button class="w-full flex items-center justify-between px-6 py-5 text-left group"
                                @click="open = open === '{{ $key }}' ? null : '{{ $key }}'">
                            <span class="text-white font-semibold pr-4 group-hover:text-gray-300 transition-colors">{{ $faq['q'] }}</span>
                            <span class="shrink-0 w-6 h-6 rounded-full bg-white/5 flex items-center justify-center transition-transform duration-200"
                                  :class="open === '{{ $key }}' ? 'rotate-45 bg-white/15' : ''">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            </span>
                        </button>
                        <div x-show="open === '{{ $key }}'"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             style="display:none;">
                            <div class="px-6 pb-6 text-gray-400 text-sm leading-relaxed border-t border-white/5 pt-4">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-[#07070c]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-[#0d0d18] border border-white/10 rounded-3xl p-10">
            <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
            <h2 class="text-3xl font-black text-white mb-4">Still Have Questions?</h2>
            <p class="text-gray-400 mb-8 leading-relaxed">Our team is happy to walk you through anything you'd like to know before getting started.</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-black font-bold px-7 py-4 rounded-2xl transition-all hover:-translate-y-0.5">
                    Send Us a Message
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold px-7 py-4 rounded-2xl transition-all">
                    View Our Services
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
