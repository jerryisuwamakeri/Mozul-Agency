@extends('layouts.public')
@section('title', $post->meta_title ?? $post->title)
@section('subtitle', 'Blog')
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('content')

{{-- Reading progress bar --}}
<div id="reading-progress"></div>

<div class="bg-gray-50 min-h-screen">
<article class="pt-24 pb-20">

    {{-- Hero header --}}
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 mb-10">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-3 mb-8 text-sm">
            <a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-gray-900 font-medium transition-colors">Blog</a>
            @if($post->category)
            <span class="text-gray-300">›</span>
            <span class="text-gray-400 font-medium">{{ $post->category->name }}</span>
            @endif
        </div>

        {{-- Category badge --}}
        @if($post->category)
        <span class="inline-block bg-black text-white text-[11px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest mb-5">{{ $post->category->name }}</span>
        @endif

        {{-- Title --}}
        <h1 class="text-4xl sm:text-5xl font-black text-gray-900 leading-[1.1] tracking-tight mb-5">
            {{ $post->title }}
        </h1>

        @if($post->excerpt)
        <p class="text-gray-500 text-lg leading-relaxed mb-8">{{ $post->excerpt }}</p>
        @endif

        {{-- Meta + share row --}}
        <div class="flex flex-wrap items-center justify-between gap-4 pb-8 border-b border-gray-200">
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400">
                @if($post->author)
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-black flex items-center justify-center text-white text-xs font-black shrink-0">{{ strtoupper(substr($post->author->name,0,1)) }}</div>
                    <span class="text-gray-700 font-medium">{{ $post->author->name }}</span>
                </div>
                <span class="text-gray-300">·</span>
                @endif
                <time>{{ $post->published_at?->format('F j, Y') }}</time>
                <span class="text-gray-300">·</span>
                <span>{{ $post->reading_time }}</span>
            </div>
            <div class="flex items-center gap-1.5">
                @include('blog._share', ['post' => $post])
            </div>
        </div>
    </div>

    {{-- Featured image --}}
    @if($post->featured_image)
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="rounded-2xl overflow-hidden aspect-video shadow-lg bg-gray-100">
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
    </div>
    @endif

    {{-- Article body --}}
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8" id="article-body">
        <div class="prose prose-gray max-w-none
            prose-headings:font-black prose-headings:text-gray-900 prose-headings:tracking-tight
            prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
            prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
            prose-p:text-gray-600 prose-p:leading-[1.85] prose-p:text-[17px]
            prose-a:text-gray-900 prose-a:font-medium prose-a:underline prose-a:underline-offset-4 hover:prose-a:no-underline
            prose-strong:text-gray-900 prose-strong:font-bold
            prose-li:text-gray-600 prose-li:text-[17px]
            prose-blockquote:border-gray-300 prose-blockquote:text-gray-500 prose-blockquote:text-lg prose-blockquote:font-normal prose-blockquote:not-italic
            prose-code:text-gray-800 prose-code:bg-gray-100 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:text-sm prose-code:before:content-none prose-code:after:content-none
            prose-pre:bg-gray-900 prose-pre:border prose-pre:border-gray-200 prose-pre:rounded-xl
            prose-img:rounded-xl prose-img:shadow-md
            prose-hr:border-gray-200">
            {!! $post->content !!}
        </div>

        {{-- Share footer --}}
        <div class="mt-14 pt-8 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <p class="text-gray-900 font-bold mb-1">Found this useful?</p>
                <p class="text-gray-500 text-sm">Share it with someone who needs it.</p>
            </div>
            <div class="flex items-center gap-2">
                @include('blog._share', ['post' => $post])
            </div>
        </div>
    </div>
</article>
</div>

{{-- Related posts --}}
@if($related->count())
<section class="py-16 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-black text-gray-900 mb-8">More Articles</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($related as $r)
            <a href="{{ route('blog.show', $r->slug) }}"
               class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col">
                <div class="aspect-video overflow-hidden bg-gray-100">
                    @if($r->featured_image)
                    <img src="{{ Storage::url($r->featured_image) }}" alt="{{ $r->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center"><svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg></div>
                    @endif
                </div>
                <div class="p-5 flex flex-col flex-1">
                    @if($r->category)<span class="text-gray-400 text-[11px] font-bold uppercase tracking-widest mb-2 block">{{ $r->category->name }}</span>@endif
                    <h3 class="text-gray-900 font-bold text-lg leading-snug mb-auto line-clamp-2 group-hover:text-gray-600 transition-colors">{{ $r->title }}</h3>
                    <div class="flex items-center justify-between text-xs text-gray-400 pt-4 border-t border-gray-100 mt-4">
                        <span>{{ $r->published_at?->format('M j, Y') }}</span>
                        <span>{{ $r->reading_time }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
const bar = document.getElementById('reading-progress')
const article = document.getElementById('article-body')
if (bar && article) {
    window.addEventListener('scroll', () => {
        const rect = article.getBoundingClientRect()
        const pct = Math.min(100, Math.max(0, (-rect.top / article.offsetHeight) * 100))
        bar.style.width = pct + '%'
    }, { passive: true })
}
</script>
@endpush
@endsection
