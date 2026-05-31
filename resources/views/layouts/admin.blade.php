<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Mozul Africa Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#0b0b12] text-gray-100">
<div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-60 bg-[#0d0d15] border-r border-white/5 transform transition-transform duration-200 lg:translate-x-0 lg:static lg:inset-auto lg:transform-none flex flex-col shrink-0">

        {{-- Logo --}}
        <div class="px-5 py-5 border-b border-white/5">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('Logo.png') }}" alt="Mozul Africa" class="h-10 w-auto">
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 overflow-y-auto space-y-0.5">
            @php
            $navItems = [
                ['route'=>'admin.dashboard',         'label'=>'Dashboard',        'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route'=>'admin.blog.index',        'label'=>'Blog Posts',       'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ['route'=>'admin.blog-categories.index','label'=>'Categories',    'icon'=>'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z'],
                ['route'=>'admin.courses.index',     'label'=>'Courses',          'icon'=>'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['route'=>'admin.submissions.index', 'label'=>'Submissions',      'icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'badge'=>\App\Models\ContactSubmission::where('is_read',false)->count()],
                ['route'=>'admin.reviews.index',     'label'=>'Reviews',          'icon'=>'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
                ['route'=>'admin.settings.index',   'label'=>'Settings',          'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
            ];
            @endphp
            @foreach($navItems as $item)
            @php $isActive = request()->routeIs($item['route'].'*') @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ $isActive ? 'bg-white text-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-[17px] h-[17px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                <span class="flex-1">{{ $item['label'] }}</span>
                @if(!empty($item['badge']) && $item['badge'] > 0)
                <span class="bg-white/20 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center {{ $isActive ? 'bg-black/15 text-black' : '' }}">{{ $item['badge'] }}</span>
                @endif
            </a>
            @endforeach
        </nav>

        {{-- Bottom: user + links --}}
        <div class="px-3 py-4 border-t border-white/5 space-y-0.5">
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2.5 text-gray-500 hover:text-white text-sm rounded-lg hover:bg-white/5 transition-all">
                <svg class="w-[17px] h-[17px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Website
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 text-gray-500 hover:text-red-400 text-sm rounded-lg hover:bg-red-400/5 transition-all">
                    <svg class="w-[17px] h-[17px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
            <div class="flex items-center gap-3 px-3 py-2.5 mt-1">
                <div class="w-7 h-7 bg-white/10 rounded-full flex items-center justify-center text-white font-bold text-xs shrink-0">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="min-w-0">
                    <div class="text-white text-xs font-semibold truncate">{{ auth()->user()->name }}</div>
                    <div class="text-gray-600 text-[10px] truncate">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>
    </aside>

    {{-- Mobile overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen=false" class="fixed inset-0 bg-black/70 z-40 lg:hidden"></div>

    {{-- Main content --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Top bar --}}
        <header class="flex items-center justify-between px-6 h-14 border-b border-white/5 bg-[#0d0d15] shrink-0">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen=true" class="lg:hidden text-gray-400 hover:text-white p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-gray-500">Admin</span>
                    <span class="text-gray-700">/</span>
                    <span class="text-white font-medium">@yield('title', 'Dashboard')</span>
                </div>
            </div>
            <a href="{{ route('admin.blog.create') }}"
               class="hidden sm:inline-flex items-center gap-1.5 bg-white text-black text-xs font-bold px-3.5 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                New Post
            </a>
        </header>

        {{-- Page content --}}
        <main class="flex-1 overflow-y-auto p-6 space-y-6">
            @if(session('success'))
            <div x-data="{show:true}" x-show="show"
                 class="flex items-center justify-between bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl px-4 py-3 text-sm">
                <span>{{ session('success') }}</span>
                <button @click="show=false"><svg class="w-4 h-4 opacity-60 hover:opacity-100" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
            </div>
            @endif
            @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl px-4 py-3 text-sm">{{ session('error') }}</div>
            @endif

            @yield('admin-content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
