<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', \App\Models\Setting::get('site_name', 'Mozul Africa')) — @yield('subtitle', 'Creative Digital Marketing Agency')</title>
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', ''))">
    <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#0a0a0f] text-gray-100">

    {{-- Navbar --}}
    <nav x-data="{ open: false }"
         class="fixed inset-x-0 top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('Logo.png') }}" alt="Mozul Africa" class="h-16 w-auto">
                </a>
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-black text-sm font-medium transition-colors">Home</a>
                    <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-black text-sm font-medium transition-colors">Services</a>
                    <a href="{{ route('why-us.index') }}" class="text-gray-600 hover:text-black text-sm font-medium transition-colors">Why Us</a>
                    <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-black text-sm font-medium transition-colors">Courses</a>
                    <a href="{{ route('faqs.index') }}" class="text-gray-600 hover:text-black text-sm font-medium transition-colors">FAQs</a>
                    <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-black text-sm font-medium transition-colors">Blog</a>
                    <a href="{{ route('contact.index') }}" class="text-gray-600 hover:text-black text-sm font-medium transition-colors">Contact</a>
                    <a href="{{ route('contact.index') }}" class="bg-black text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-gray-800 transition-colors">
                        Book a Call
                    </a>
                </div>
                <button @click="open = !open" class="md:hidden text-gray-600 p-2">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
        {{-- Mobile Menu --}}
        <div x-show="open" x-transition class="md:hidden bg-white border-t border-gray-100 px-4 py-6 space-y-4">
            <a href="{{ route('home') }}" class="block text-gray-600 hover:text-black font-medium">Home</a>
            <a href="{{ route('services.index') }}" class="block text-gray-600 hover:text-black font-medium">Services</a>
            <a href="{{ route('why-us.index') }}" class="block text-gray-600 hover:text-black font-medium">Why Us</a>
            <a href="{{ route('courses.index') }}" class="block text-gray-600 hover:text-black font-medium">Courses</a>
            <a href="{{ route('faqs.index') }}" class="block text-gray-600 hover:text-black font-medium">FAQs</a>
            <a href="{{ route('blog.index') }}" class="block text-gray-600 hover:text-black font-medium">Blog</a>
            <a href="{{ route('contact.index') }}" class="block text-gray-600 hover:text-black font-medium">Contact</a>
            <a href="{{ route('contact.index') }}" class="block bg-black text-white px-5 py-3 rounded-xl font-semibold text-center">Book a Call</a>
        </div>
    </nav>

    <main>@yield('content')</main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="md:col-span-2">
                    <a href="{{ route('home') }}" class="inline-block mb-5">
                        <img src="{{ asset('Logo.png') }}" alt="Mozul Africa" class="h-16 w-auto">
                    </a>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-sm">Creative Digital Marketing Agency helping African brands grow, lead, and last in the digital economy.</p>
                    <p class="text-gray-600 font-medium mt-4 text-sm italic">Created to Create.</p>
                </div>
                <div>
                    <h4 class="text-gray-900 font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="{{ route('services.index') }}" class="hover:text-black transition-colors">Digital Strategy</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-black transition-colors">Social Media</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-black transition-colors">Paid Advertising</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-black transition-colors">Content Creation</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-black transition-colors">Brand Identity</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-black transition-colors">Email Marketing</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-gray-900 font-semibold mb-4">Contact</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg> {{ \App\Models\Setting::get('site_email', 'hello@mozulafrica.com') }}</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg> {{ \App\Models\Setting::get('site_phone', '+234 (0) 813 929 4463') }}</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg> {{ \App\Models\Setting::get('site_address', 'Nigeria') }}</li>
                    </ul>
                    <div class="flex gap-3 mt-6">
                        @if(\App\Models\Setting::get('social_instagram'))<a href="{{ \App\Models\Setting::get('social_instagram') }}" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors text-gray-600"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>@endif
                        @if(\App\Models\Setting::get('social_twitter'))<a href="{{ \App\Models\Setting::get('social_twitter') }}" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors text-gray-600"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>@endif
                        @if(\App\Models\Setting::get('social_linkedin'))<a href="{{ \App\Models\Setting::get('social_linkedin') }}" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors text-gray-600"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>@endif
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-400">
                <p>© {{ date('Y') }} Mozul Africa. All rights reserved.</p>
                <p>Strategy · Brand · Content · Growth</p>
            </div>
        </div>
    </footer>
@stack('scripts')
</body>
</html>
