@extends('layouts.public')
@section('title', 'Services')
@section('subtitle', 'What We Do')

@section('content')

@php
$services = [
    ['num'=>'01','title'=>'Digital Marketing Strategy','tagline'=>'Clarity before campaigns. Direction before spend.','desc'=>'Market research, audience targeting, campaign planning, growth roadmaps, and KPI development tailored to your business goals.','icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z','overview'=>'A powerful digital presence starts with a well-defined strategy. Before any campaign goes live, we take time to understand your business, audience, and competitive landscape — then build a tailored roadmap that aligns your online activities with your broader business objectives.','deliverables'=>['Marketing & brand audit','Audience research & segmentation','Competitor landscape analysis','Digital marketing roadmap','Channel strategy (organic & paid)','KPI framework & tracking setup'],'process'=>['Discovery call & briefing','Research & audit phase','Strategy document','Presentation & approval','Execution planning'],'idealFor'=>['Brands entering a new market','Businesses with no clear digital direction','Companies scaling marketing teams','Startups preparing for launch'],'timeline'=>'2 – 4 weeks'],
    ['num'=>'02','title'=>'Social Media Management','tagline'=>'Consistent. Creative. Community-driven.','desc'=>'Content calendars, creative direction, community management, monthly reporting, and brand consistency across all platforms.','icon'=>'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z','overview'=>'Social media is your brand\'s most visible daily touchpoint. We take full ownership of your social presence — from strategy and content creation to community engagement and performance reporting — ensuring every post reflects your brand voice and moves your audience toward action.','deliverables'=>['Monthly content calendar','15–20 posts per month per platform','Creative direction & copy','Community management & replies','Hashtag & SEO optimisation','Monthly analytics report'],'process'=>['Brand voice & audit','Content strategy','Calendar creation & approval','Scheduling & publishing','Engagement & reporting'],'idealFor'=>['Brands wanting consistent social presence','Businesses without in-house content teams','Founders building personal brands','SMEs scaling digital visibility'],'timeline'=>'Ongoing monthly retainer'],
    ['num'=>'03','title'=>'Paid Advertising','tagline'=>'Precision targeting. Maximum return.','desc'=>'Meta Ads, Google Ads, campaign optimisation, audience targeting, and ROAS reporting to maximise your ad spend.','icon'=>'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z','overview'=>'Paid advertising done right is one of the fastest paths to growth. We manage end-to-end paid campaigns across Meta and Google — from audience research and creative direction to budget optimisation and performance reporting. Every kobo you spend is tracked, tested, and optimised.','deliverables'=>['Ad account setup & audit','Audience research & targeting','Ad creative direction & copy','Campaign setup & launch','A/B testing & optimisation','Weekly ROAS & performance reports'],'process'=>['Audit & account setup','Audience & competitor research','Creative brief & ad copy','Campaign launch','Ongoing optimisation & reporting'],'idealFor'=>['Businesses ready to scale with budget','E-commerce brands driving sales','Service businesses generating leads','Brands launching new products'],'timeline'=>'Ongoing monthly management'],
    ['num'=>'04','title'=>'Content Creation','tagline'=>'Words and ideas that move people.','desc'=>'Copywriting, video scripting, editorial planning, thought leadership, and content repurposing across channels.','icon'=>'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z','overview'=>'Content is the foundation of every digital strategy. We produce high-quality written and visual content that educates, entertains, and converts. From blog articles and social copy to video scripts and thought leadership pieces, we create content that positions your brand as the authority in your space.','deliverables'=>['Blog articles & SEO content','Social media copy & captions','Video & podcast scripts','Thought leadership articles','Email sequences & newsletters','Content repurposing across channels'],'process'=>['Content audit & brief','Editorial calendar planning','Drafting & review','Approval & publishing','Performance tracking'],'idealFor'=>['Brands needing consistent content output','Executives building thought leadership','Businesses entering content marketing','Agencies needing white-label content'],'timeline'=>'Project-based or monthly retainer'],
    ['num'=>'05','title'=>'Brand Identity & Design','tagline'=>'Make them remember you.','desc'=>'Logo design, brand guidelines, messaging systems, campaign creatives, and visual strategy that makes you unforgettable.','icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z','overview'=>'Your brand is more than a logo — it\'s the entire experience people have with your business. We craft cohesive brand identities that communicate your values, differentiate you from competitors, and build lasting recognition. From visual identity to messaging frameworks, we make your brand impossible to ignore.','deliverables'=>['Logo suite (primary, secondary, icon)','Brand colour & typography system','Brand guidelines document','Messaging & tone of voice guide','Social media templates','Campaign creative assets'],'process'=>['Brand discovery workshop','Research & moodboarding','Concept development','Refinement & approval','Final delivery (AI, PDF, PNG)'],'idealFor'=>['New businesses building from scratch','Established brands ready to rebrand','Executives building personal brands','Businesses seeking visual consistency'],'timeline'=>'3 – 6 weeks'],
    ['num'=>'06','title'=>'Email Marketing & Automation','tagline'=>'Your highest-ROI channel, fully optimised.','desc'=>'Email campaigns, automation flows, segmentation, newsletter strategy, and conversion optimisation.','icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z','overview'=>'Email remains the highest-ROI digital marketing channel when executed correctly. We build and manage email programmes that nurture leads, retain customers, and drive consistent revenue. From welcome sequences to complex automation flows, we turn your list into a reliable growth engine.','deliverables'=>['Email audit & list segmentation','Welcome & onboarding sequences','Automation flow setup','Monthly campaign design & copy','A/B testing & optimisation','Open rate & conversion reporting'],'process'=>['Audit & platform setup','Segmentation & tagging','Flow & automation build','Campaign creation & scheduling','Reporting & optimisation'],'idealFor'=>['E-commerce brands increasing repeat purchases','Service businesses nurturing leads','Course creators & coaches','Businesses with inactive email lists'],'timeline'=>'Setup: 2–3 weeks, then monthly management'],
];
@endphp

{{-- Page Header --}}
<section class="relative pt-40 pb-20 bg-[#07070c] overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.015%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">What We Do</span>
        <h1 class="text-5xl lg:text-6xl font-black text-white leading-tight mb-6">Our Services</h1>
        <p class="text-gray-400 text-lg max-w-2xl leading-relaxed">Designed to help brands grow with intention, consistency, and measurable impact. Click any service to learn more.</p>
    </div>
</section>

{{-- Services Grid + Modal --}}
<div x-data="{
    open: false,
    selected: null,
    services: @js($services),
    openModal(i) { this.selected = i; this.open = true; document.body.style.overflow = 'hidden'; },
    closeModal() { this.open = false; setTimeout(() => this.selected = null, 200); document.body.style.overflow = ''; }
}" @keydown.escape.window="closeModal()">

<section class="py-20 bg-[#0a0a0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-px bg-white/5 rounded-3xl overflow-hidden">
            @foreach($services as $i => $service)
            <div class="group bg-[#0a0a0f] hover:bg-[#111120] p-8 transition-colors duration-300 relative cursor-pointer"
                 @click="openModal({{ $i }})">
                <div class="absolute top-8 right-8 text-5xl font-black text-white/[0.04] font-mono group-hover:text-white/10 transition-colors">{{ $service['num'] }}</div>
                <div class="w-12 h-12 bg-white/10 group-hover:bg-white/15 rounded-2xl flex items-center justify-center mb-6 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}"/></svg>
                </div>
                <h3 class="text-white font-bold text-xl mb-3 group-hover:text-gray-300 transition-colors">{{ $service['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">{{ $service['desc'] }}</p>
                <div class="flex items-center gap-2 text-white/60 group-hover:text-white text-sm font-semibold transition-colors">
                    <span>Learn more</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Modal --}}
<div x-show="open"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
     style="display:none;">
    <div class="absolute inset-0 bg-black/80" @click="closeModal()"></div>
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="relative bg-[#0d0d18] border border-white/10 rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-y-auto z-10">
        <template x-if="selected !== null">
            <div>
                <div class="sticky top-0 bg-[#0d0d18] border-b border-white/5 px-8 py-5 flex items-center justify-between rounded-t-3xl z-10">
                    <div class="flex items-center gap-4">
                        <span class="text-white/30 font-mono text-xs" x-text="services[selected].num"></span>
                        <h2 class="text-white font-black text-lg" x-text="services[selected].title"></h2>
                    </div>
                    <button @click="closeModal()" class="w-8 h-8 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-8 space-y-8">
                    <p class="text-gray-300 font-semibold italic" x-text="services[selected].tagline"></p>
                    <div>
                        <h3 class="text-white font-bold mb-3 text-sm uppercase tracking-widest">Overview</h3>
                        <p class="text-gray-400 leading-relaxed text-sm" x-text="services[selected].overview"></p>
                    </div>
                    <div class="grid sm:grid-cols-3 gap-6">
                        <div>
                            <h3 class="text-white font-bold mb-4 text-sm uppercase tracking-widest flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> Deliverables
                            </h3>
                            <ul class="space-y-2">
                                <template x-for="item in services[selected].deliverables" :key="item">
                                    <li class="flex items-start gap-2 text-gray-400 text-sm">
                                        <svg class="w-3.5 h-3.5 text-white mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        <span x-text="item"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-white font-bold mb-4 text-sm uppercase tracking-widest flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> Our Process
                            </h3>
                            <ol class="space-y-2">
                                <template x-for="(step, idx) in services[selected].process" :key="step">
                                    <li class="flex items-start gap-2 text-gray-400 text-sm">
                                        <span class="text-white/40 font-mono text-xs mt-0.5 shrink-0 w-4" x-text="(idx+1) + '.'"></span>
                                        <span x-text="step"></span>
                                    </li>
                                </template>
                            </ol>
                        </div>
                        <div>
                            <h3 class="text-white font-bold mb-4 text-sm uppercase tracking-widest flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> Ideal For
                            </h3>
                            <ul class="space-y-2">
                                <template x-for="item in services[selected].idealFor" :key="item">
                                    <li class="flex items-start gap-2 text-gray-400 text-sm">
                                        <span class="text-white/40 mt-1 shrink-0">→</span>
                                        <span x-text="item"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-4 border-t border-white/5">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-gray-400 text-sm">Timeline: <span class="text-white font-semibold" x-text="services[selected].timeline"></span></span>
                        </div>
                        <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-black font-bold px-6 py-3 rounded-xl transition-all text-sm">
                            Get Started
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
</div>

{{-- Legacy Branding --}}
<section class="py-28 bg-[#07070c] relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-white/[0.02] via-transparent to-transparent"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1">
                <div class="bg-[#13131f] border border-white/10 rounded-3xl p-8 lg:p-10">
                    <h3 class="text-white font-bold text-2xl mb-8">Who This Programme Is For</h3>
                    <div class="space-y-5">
                        @foreach(['CEOs & Managing Directors','Senior Executives & Directors','Seasoned Consultants & Advisors','Public Figures & Keynote Speakers','Board Members & Industry Leaders'] as $role)
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-gray-300">{{ $role }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-8 pt-8 border-t border-white/5">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            <span class="text-white/60 text-sm italic">Transform decades of expertise into lasting digital influence</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">Legacy Branding Programme</span>
                <h2 class="text-4xl lg:text-5xl font-black text-white mb-6 leading-tight">
                    Your Career Built Influence.<br><em class="not-italic text-gray-300">Your Brand Should Preserve It.</em>
                </h2>
                <p class="text-gray-400 leading-relaxed mb-5">Mozul Africa's Legacy Branding Programme helps CEOs, executives, and senior professionals build credible digital platforms that extend their influence beyond the boardroom.</p>
                <p class="text-gray-400 leading-relaxed mb-8">We help leaders transform decades of experience into thought leadership, consulting opportunities, speaking visibility, and lasting professional relevance.</p>
                <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-black font-bold px-7 py-4 rounded-2xl transition-all hover:-translate-y-0.5">
                    Build Your Legacy
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-[#0a0a0f]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-black text-white mb-5">Ready to Get Started?</h2>
        <p class="text-gray-400 mb-8 leading-relaxed">Tell us about your brand and we'll put together the right strategy for you.</p>
        <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-black font-bold px-8 py-4 rounded-2xl transition-all hover:-translate-y-0.5">
            Book a Discovery Call
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</section>

@endsection
