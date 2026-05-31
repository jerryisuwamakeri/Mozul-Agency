@extends('layouts.admin')
@section('title', 'Dashboard')

@section('admin-content')

@php
$hour = now()->format('G');
$greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
$name = explode(' ', auth()->user()->name)[0];
@endphp

{{-- Header --}}
<div class="flex items-end justify-between mb-10">
    <div>
        <p class="text-gray-500 text-sm mb-1">{{ $greeting }}, {{ $name }}</p>
        <h1 class="text-white text-3xl font-black tracking-tight">Here's your overview</h1>
    </div>
    <span class="text-gray-600 text-sm hidden sm:block">{{ now()->format('l, j F Y') }}</span>
</div>

{{-- Metrics strip --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 border border-white/5 rounded-2xl overflow-hidden mb-6">
    @php
    $metrics = [
        ['n' => $stats['posts'],       'label' => 'Blog Posts'],
        ['n' => $stats['published'],   'label' => 'Published'],
        ['n' => $stats['submissions'], 'label' => 'Submissions'],
        ['n' => $stats['unread'],      'label' => 'Unread',      'alert' => $stats['unread'] > 0],
        ['n' => $stats['reviews'],     'label' => 'Reviews'],
        ['n' => $stats['pending'],     'label' => 'Pending'],
    ];
    @endphp
    @foreach($metrics as $i => $m)
    <div class="px-6 py-5 {{ $i > 0 ? 'border-l border-white/5' : '' }} {{ !empty($m['alert']) ? 'bg-white/[0.03]' : 'bg-[#13131f]' }}">
        <div class="text-3xl font-black {{ !empty($m['alert']) ? 'text-white' : 'text-white' }} tabular-nums">{{ $m['n'] }}</div>
        <div class="text-gray-500 text-xs mt-1.5 font-medium">{{ $m['label'] }}
            @if(!empty($m['alert']))<span class="ml-1.5 inline-block w-1.5 h-1.5 rounded-full bg-white align-middle"></span>@endif
        </div>
    </div>
    @endforeach
</div>

{{-- Unread alert --}}
@if($stats['unread'] > 0)
<div class="flex items-center justify-between bg-white text-black px-5 py-3.5 rounded-xl mb-6">
    <div class="flex items-center gap-3">
        <div class="w-2 h-2 rounded-full bg-black animate-pulse"></div>
        <span class="text-sm font-semibold">{{ $stats['unread'] }} unread {{ Str::plural('submission', $stats['unread']) }} waiting for your review</span>
    </div>
    <a href="{{ route('admin.submissions.index') }}" class="text-xs font-bold underline underline-offset-2 hover:no-underline">View inbox →</a>
</div>
@endif

{{-- Main two-panel layout --}}
<div class="grid lg:grid-cols-5 gap-5">

    {{-- Submissions inbox --}}
    <div class="lg:col-span-3 bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/5">
            <div class="flex items-center gap-2.5">
                <span class="text-white font-semibold text-sm">Inbox</span>
                @if($stats['unread'] > 0)
                <span class="bg-white text-black text-[10px] font-black px-1.5 py-0.5 rounded-full leading-none">{{ $stats['unread'] }}</span>
                @endif
            </div>
            <a href="{{ route('admin.submissions.index') }}" class="text-gray-600 hover:text-white text-xs font-medium transition-colors">All submissions →</a>
        </div>

        @if($recentSubmissions->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <svg class="w-8 h-8 text-gray-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <p class="text-gray-600 text-sm">Your inbox is empty</p>
        </div>
        @else
        @foreach($recentSubmissions as $sub)
        <a href="{{ route('admin.submissions.show', $sub) }}"
           class="flex items-start gap-4 px-6 py-4 border-b border-white/5 last:border-0 hover:bg-white/[0.03] transition-colors group {{ !$sub->is_read ? 'bg-white/[0.02]' : '' }}">
            {{-- Unread dot --}}
            <div class="mt-1.5 shrink-0">
                <div class="w-1.5 h-1.5 rounded-full {{ !$sub->is_read ? 'bg-white' : 'bg-transparent' }}"></div>
            </div>
            {{-- Avatar --}}
            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white text-xs font-bold shrink-0">
                {{ strtoupper(substr($sub->name, 0, 1)) }}
            </div>
            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-baseline justify-between gap-2">
                    <span class="text-sm font-semibold {{ !$sub->is_read ? 'text-white' : 'text-gray-300' }} truncate">{{ $sub->name }}</span>
                    <span class="text-gray-600 text-xs shrink-0">{{ $sub->created_at->diffForHumans(null, true) }}</span>
                </div>
                <p class="text-gray-500 text-xs mt-0.5 truncate">
                    {{ $sub->service_interest ?: $sub->email }}
                </p>
            </div>
        </a>
        @endforeach
        @endif
    </div>

    {{-- Blog posts + actions --}}
    <div class="lg:col-span-2 flex flex-col gap-5">

        {{-- Blog posts --}}
        <div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden flex-1">
            <div class="flex items-center justify-between px-5 py-4 border-b border-white/5">
                <span class="text-white font-semibold text-sm">Blog Posts</span>
                <a href="{{ route('admin.blog.create') }}"
                   class="inline-flex items-center gap-1 text-[11px] font-bold text-black bg-white px-2.5 py-1 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    New
                </a>
            </div>

            @if($recentPosts->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-center px-5">
                <svg class="w-7 h-7 text-gray-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <p class="text-gray-600 text-xs">No posts yet</p>
                <a href="{{ route('admin.blog.create') }}" class="text-white text-xs hover:underline mt-2">Write your first post →</a>
            </div>
            @else
            @foreach($recentPosts as $post)
            <div class="flex items-center gap-3 px-5 py-3.5 border-b border-white/5 last:border-0 hover:bg-white/[0.03] transition-colors group">
                <div class="flex-1 min-w-0">
                    <div class="text-gray-200 text-sm font-medium truncate group-hover:text-white transition-colors">{{ $post->title }}</div>
                    <div class="text-gray-600 text-xs mt-0.5">{{ $post->category?->name ?? 'Uncategorised' }}</div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-[11px] font-semibold {{ $post->status === 'published' ? 'text-green-400' : 'text-gray-600' }}">
                        {{ $post->status === 'published' ? '● Live' : '○ Draft' }}
                    </span>
                    <a href="{{ route('admin.blog.edit', $post) }}" class="text-gray-700 hover:text-white transition-colors opacity-0 group-hover:opacity-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        {{-- Jump to --}}
        <div class="bg-[#13131f] border border-white/5 rounded-2xl p-4">
            <p class="text-gray-600 text-[11px] font-semibold uppercase tracking-widest mb-3">Jump to</p>
            <div class="grid grid-cols-2 gap-2">
                @foreach([
                    ['route'=>'admin.submissions.index','label'=>'Submissions','icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ['route'=>'admin.reviews.index',    'label'=>'Reviews',    'icon'=>'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
                    ['route'=>'admin.settings.index',  'label'=>'Settings',   'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                    ['route'=>'home',                  'label'=>'Website',    'icon'=>'M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14', 'blank'=>true],
                ] as $link)
                <a href="{{ route($link['route']) }}" {{ !empty($link['blank']) ? 'target=_blank' : '' }}
                   class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white text-xs font-medium transition-all">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/></svg>
                    {{ $link['label'] }}
                </a>
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection
