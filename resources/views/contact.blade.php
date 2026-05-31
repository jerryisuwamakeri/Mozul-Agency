@extends('layouts.public')
@section('title', 'Contact Us')
@section('subtitle', 'Get In Touch')

@section('content')

<section class="relative pt-40 pb-20 bg-[#07070c] overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.015%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="inline-block text-white text-xs font-bold uppercase tracking-[0.2em] mb-5 after:block after:mt-2 after:w-10 after:h-0.5 after:bg-white">Get In Touch</span>
        <h1 class="text-5xl lg:text-6xl font-black text-white leading-tight mb-6">Let's Build Something <span class="text-gray-300">Remarkable</span></h1>
        <p class="text-gray-400 text-lg max-w-2xl leading-relaxed">Whether you are launching a new brand, scaling an existing business, or building a legacy that lasts — we are ready to help.</p>
    </div>
</section>

<section class="py-20 bg-[#0a0a0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div>
                <h2 class="text-3xl font-black text-white mb-8">Contact Information</h2>
                <div class="space-y-5 mb-10">
                    <a href="mailto:{{ \App\Models\Setting::get('site_email','hello@mozulafrica.com') }}" class="flex items-center gap-4 group">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/15 rounded-2xl flex items-center justify-center transition-colors shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs mb-0.5">Email</div>
                            <div class="text-white group-hover:text-gray-300 transition-colors">{{ \App\Models\Setting::get('site_email','hello@mozulafrica.com') }}</div>
                        </div>
                    </a>
                    <a href="tel:{{ \App\Models\Setting::get('site_phone') }}" class="flex items-center gap-4 group">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/15 rounded-2xl flex items-center justify-center transition-colors shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs mb-0.5">Phone</div>
                            <div class="text-white group-hover:text-gray-300 transition-colors">{{ \App\Models\Setting::get('site_phone','+234 (0) 813 929 4463') }}</div>
                        </div>
                    </a>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs mb-0.5">Location</div>
                            <div class="text-white">{{ \App\Models\Setting::get('site_address','Nigeria') }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-[#0d0d18] border border-white/5 rounded-2xl p-6">
                    <h3 class="text-white font-semibold mb-3">Our Promise</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">We respond to every inquiry within 24 hours. Once we connect, we take the time to understand your goals before recommending any solution.</p>
                    <div class="mt-4 flex items-center gap-2">
                        <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                        <span class="text-white/60 text-sm font-medium">Currently accepting new clients</span>
                    </div>
                </div>
            </div>
            <div class="bg-[#0d0d18] border border-white/5 rounded-3xl p-8 lg:p-10">
                @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/25 text-green-400 rounded-xl px-4 py-3 mb-6 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
                @endif
                <h3 class="text-white font-bold text-2xl mb-6">Send Us a Message</h3>
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-gray-500 text-xs font-semibold uppercase tracking-wide mb-2">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="John Doe" class="w-full bg-[#13131f] border border-white/8 hover:border-white/20 focus:border-white/40 focus:ring-1 focus:ring-white/10 text-white rounded-xl px-4 py-3.5 text-sm outline-none transition placeholder-gray-600">
                            @error('name')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-gray-500 text-xs font-semibold uppercase tracking-wide mb-2">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="john@company.com" class="w-full bg-[#13131f] border border-white/8 hover:border-white/20 focus:border-white/40 focus:ring-1 focus:ring-white/10 text-white rounded-xl px-4 py-3.5 text-sm outline-none transition placeholder-gray-600">
                            @error('email')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-gray-500 text-xs font-semibold uppercase tracking-wide mb-2">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+234 ..." class="w-full bg-[#13131f] border border-white/8 hover:border-white/20 focus:border-white/40 text-white rounded-xl px-4 py-3.5 text-sm outline-none transition placeholder-gray-600">
                        </div>
                        <div>
                            <label class="block text-gray-500 text-xs font-semibold uppercase tracking-wide mb-2">Company</label>
                            <input type="text" name="company" value="{{ old('company') }}" placeholder="Your company" class="w-full bg-[#13131f] border border-white/8 hover:border-white/20 focus:border-white/40 text-white rounded-xl px-4 py-3.5 text-sm outline-none transition placeholder-gray-600">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-500 text-xs font-semibold uppercase tracking-wide mb-2">Service of Interest</label>
                        <select name="service_interest" class="w-full bg-[#13131f] border border-white/8 hover:border-white/20 focus:border-white/40 text-gray-300 rounded-xl px-4 py-3.5 text-sm outline-none transition">
                            <option value="">Select a service...</option>
                            @foreach(['Digital Marketing Strategy','Social Media Management','Paid Advertising','Content Creation','Brand Identity & Design','Email Marketing & Automation','Legacy Branding Programme'] as $svc)
                            <option value="{{ $svc }}" {{ old('service_interest')==$svc?'selected':'' }}>{{ $svc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-500 text-xs font-semibold uppercase tracking-wide mb-2">Message *</label>
                        <textarea name="message" rows="4" required placeholder="Tell us about your project or goals..." class="w-full bg-[#13131f] border border-white/8 hover:border-white/20 focus:border-white/40 focus:ring-1 focus:ring-white/10 text-white rounded-xl px-4 py-3.5 text-sm outline-none transition placeholder-gray-600 resize-none">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="w-full bg-white hover:bg-gray-100 text-black font-black py-4 rounded-2xl text-sm tracking-wide transition-all hover:-translate-y-0.5">
                        Send Message — Let's Talk Growth
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
