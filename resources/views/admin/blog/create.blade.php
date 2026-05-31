@extends('layouts.admin')
@section('title', 'New Post')

@section('admin-content')

<div class="max-w-5xl">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-7">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.blog.index') }}" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-white font-bold text-lg">New Blog Post</h1>
                <p class="text-gray-600 text-xs mt-0.5">Draft is saved when you submit</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" id="blog-form">
        @csrf

        <div class="grid lg:grid-cols-3 gap-5">

            {{-- Left: main content --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Title & excerpt --}}
                <div class="bg-[#13131f] border border-white/5 rounded-2xl p-6 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Post Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="w-full bg-transparent border-0 border-b border-white/10 text-white text-2xl font-bold focus:outline-none focus:border-white/30 transition pb-2 placeholder-gray-700"
                               placeholder="Write a compelling headline...">
                        @error('title')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Excerpt</label>
                        <textarea name="excerpt" rows="2"
                                  class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition resize-none placeholder-gray-700"
                                  placeholder="A short summary for listings and SEO (recommended: 140–160 characters)">{{ old('excerpt') }}</textarea>
                    </div>
                </div>

                {{-- WYSIWYG --}}
                <div class="bg-[#13131f] border border-white/5 rounded-2xl p-6">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Content *</label>
                    <textarea name="content" id="post-content" class="hidden">{{ old('content') }}</textarea>
                    @error('content')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- SEO --}}
                <div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
                    <button type="button" x-data="{open:false}" @click="open=!open"
                            class="w-full flex items-center justify-between px-6 py-4 text-left">
                        <span class="text-white font-semibold text-sm">SEO Settings</span>
                        <svg class="w-4 h-4 text-gray-500 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-data="{open:false}" x-show="open" class="px-6 pb-6 space-y-4 border-t border-white/5">
                        <div class="pt-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                   class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition placeholder-gray-700"
                                   placeholder="Leave blank to use post title">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="2"
                                      class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition resize-none placeholder-gray-700"
                                      placeholder="Leave blank to use excerpt">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: sidebar --}}
            <div class="space-y-5">

                {{-- Publish panel --}}
                <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5 space-y-4">
                    <h3 class="text-white font-semibold text-sm">Publish</h3>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Status</label>
                        <select name="status" class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none transition">
                            <option value="draft"     {{ old('status','draft')=='draft'     ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status')=='published'         ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Category</label>
                        <select name="blog_category_id" class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none transition">
                            <option value="">No Category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('blog_category_id')==$cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-2 flex flex-col gap-2">
                        <button type="submit" class="w-full bg-white hover:bg-gray-100 text-black font-bold py-3 rounded-xl text-sm transition-colors">
                            Save Post
                        </button>
                        <a href="{{ route('admin.blog.index') }}" class="w-full text-center bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 py-3 rounded-xl text-sm transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Featured image --}}
                <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5" x-data="{preview: null}">
                    <h3 class="text-white font-semibold text-sm mb-4">Featured Image</h3>
                    <label class="block cursor-pointer">
                        <input type="file" name="featured_image" accept="image/*" class="hidden"
                               @change="preview = URL.createObjectURL($event.target.files[0])">
                        <div x-show="!preview" class="border border-dashed border-white/15 rounded-xl p-8 text-center hover:border-white/30 transition-colors">
                            <svg class="w-7 h-7 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-gray-500 text-xs font-medium">Click to upload</p>
                            <p class="text-gray-700 text-xs mt-0.5">PNG, JPG — max 2MB</p>
                        </div>
                        <div x-show="preview" class="relative group">
                            <img :src="preview" class="w-full rounded-xl aspect-video object-cover">
                            <div class="absolute inset-0 bg-black/50 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white text-xs font-semibold">Click to change</span>
                            </div>
                        </div>
                    </label>
                </div>

            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (window.initEditor) window.initEditor('post-content')
})
</script>
@endpush
@endsection
