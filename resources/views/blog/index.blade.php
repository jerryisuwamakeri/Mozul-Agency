@extends('layouts.public')
@section('title', 'Blog')
@section('subtitle', 'Insights & Digital Marketing Tips')

@section('content')

<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-14">
            <span class="inline-block text-black text-xs font-bold uppercase tracking-[0.2em] mb-4 after:block after:mt-2 after:w-8 after:h-0.5 after:bg-black">Our Insights</span>
            <h1 class="text-5xl lg:text-6xl font-black text-gray-900 tracking-tight mb-4">Blog</h1>
            <p class="text-gray-500 text-lg max-w-xl">Strategy, insights, and stories from the Mozul Africa team.</p>
        </div>

        {{-- Category filters --}}
        @if($categories->count())
        <div class="flex flex-wrap gap-2 mb-12">
            <a href="{{ route('blog.index') }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ !request('category') ? 'bg-black text-white' : 'bg-white text-gray-500 border border-gray-200 hover:bg-gray-100 hover:text-gray-900' }}">
                All
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ request('category') == $cat->slug ? 'bg-black text-white' : 'bg-white text-gray-500 border border-gray-200 hover:bg-gray-100 hover:text-gray-900' }}">
                {{ $cat->name }}<span class="opacity-40 font-normal ml-0.5">({{ $cat->posts_count }})</span>
            </a>
            @endforeach
        </div>
        @endif

        @if($posts->isEmpty())
        <div class="flex flex-col items-center justify-center py-32 text-center">
            <div class="w-16 h-16 bg-black/5 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <p class="text-gray-900 font-bold text-xl mb-2">No posts yet</p>
            <p class="text-gray-500">Check back soon for fresh insights from our team.</p>
        </div>
        @else

        @php $allPosts = $posts->getCollection(); $first = $allPosts->first(); $rest = $allPosts->skip(1); @endphp

        {{-- Featured post --}}
        @if($first && !request('category'))
        <a href="{{ route('blog.show', $first->slug) }}"
           class="group block mb-8 bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
            <div class="grid lg:grid-cols-2">
                <div class="aspect-video lg:aspect-auto overflow-hidden bg-gray-100">
                    @if($first->featured_image)
                    <img src="{{ Storage::url($first->featured_image) }}" alt="{{ $first->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                    <div class="w-full h-full min-h-[260px] flex items-center justify-center bg-gray-100">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="p-8 lg:p-10 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="bg-black text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider">Featured</span>
                        @if($first->category)<span class="text-gray-400 text-xs font-semibold uppercase tracking-widest">{{ $first->category->name }}</span>@endif
                    </div>
                    <h2 class="text-2xl lg:text-3xl font-black text-gray-900 leading-tight mb-4 group-hover:text-gray-600 transition-colors">{{ $first->title }}</h2>
                    @if($first->excerpt)<p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">{{ $first->excerpt }}</p>@endif
                    <div class="flex items-center gap-3 text-xs text-gray-400">
                        <span>{{ $first->published_at?->format('M j, Y') }}</span>
                        <span>·</span>
                        <span>{{ $first->reading_time }}</span>
                    </div>
                </div>
            </div>
        </a>
        @php $gridPosts = $rest; @endphp
        @else
        @php $gridPosts = $allPosts; @endphp
        @endif

        {{-- Grid --}}
        @if($gridPosts->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($gridPosts as $post)
            <a href="{{ route('blog.show', $post->slug) }}"
               class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col">
                <div class="aspect-video overflow-hidden bg-gray-100">
                    @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-1">
                    @if($post->category)<span class="text-gray-400 text-[11px] font-bold uppercase tracking-widest mb-2 block">{{ $post->category->name }}</span>@endif
                    <h2 class="text-gray-900 font-bold text-lg leading-snug mb-3 group-hover:text-gray-600 transition-colors line-clamp-2 flex-1">{{ $post->title }}</h2>
                    @if($post->excerpt)<p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $post->excerpt }}</p>@endif
                    <div class="flex items-center justify-between text-xs text-gray-400 pt-4 border-t border-gray-100 mt-auto">
                        <span>{{ $post->published_at?->format('M j, Y') }}</span>
                        <span>{{ $post->reading_time }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        @if($posts->hasPages())
        <div class="mt-12 flex justify-center">{{ $posts->links() }}</div>
        @endif

        @endif
    </div>
</div>
@endsection
