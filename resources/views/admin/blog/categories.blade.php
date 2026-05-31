@extends('layouts.admin')
@section('title', 'Blog Categories')

@section('admin-content')
<div class="grid lg:grid-cols-2 gap-6 max-w-3xl">
    {{-- Add Category --}}
    <div class="bg-[#13131f] border border-white/5 rounded-2xl p-6">
        <h2 class="text-white font-bold mb-5">Add New Category</h2>
        <form method="POST" action="{{ route('admin.blog-categories.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1.5">Category Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:50 transition" placeholder="e.g. Digital Strategy">
                    @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="w-full bg-amber-400 text-black font-bold py-3 rounded-xl text-sm hover:bg-amber-300 transition-colors">Add Category</button>
            </div>
        </form>
    </div>

    {{-- Categories list --}}
    <div class="bg-[#13131f] border border-white/5 rounded-2xl p-6">
        <h2 class="text-white font-bold mb-5">Categories ({{ $categories->count() }})</h2>
        @if($categories->isEmpty())
        <p class="text-gray-500 text-sm text-center py-6">No categories yet.</p>
        @else
        <div class="space-y-2">
            @foreach($categories as $cat)
            <div class="flex items-center justify-between p-3 rounded-xl bg-white/[0.03] hover:bg-white/5 transition-colors">
                <div>
                    <span class="text-white font-medium text-sm">{{ $cat->name }}</span>
                    <span class="text-gray-500 text-xs ml-2">{{ $cat->posts_count }} posts</span>
                </div>
                <form method="POST" action="{{ route('admin.blog-categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
