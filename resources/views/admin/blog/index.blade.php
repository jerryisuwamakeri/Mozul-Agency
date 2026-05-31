@extends('layouts.admin')
@section('title', 'Blog Posts')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-white font-bold text-lg">Blog Posts</h2>
        <p class="text-gray-500 text-sm">{{ $posts->total() }} posts total</p>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="bg-amber-400 text-black font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-amber-300 transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        New Post
    </a>
</div>

<div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
    @if($posts->isEmpty())
    <div class="text-center py-16 text-gray-500">No posts yet. <a href="{{ route('admin.blog.create') }}" class="text-amber-400 hover:underline">Create your first post</a>.</div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead><tr class="border-b border-white/5 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <th class="px-6 py-4 text-left">Title</th>
                <th class="px-6 py-4 text-left">Category</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-left">Date</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-white/5">
                @foreach($posts as $post)
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="px-6 py-4">
                        <div class="text-white font-medium text-sm">{{ Str::limit($post->title, 60) }}</div>
                        @if($post->excerpt)<div class="text-gray-500 text-xs mt-0.5 truncate max-w-xs">{{ Str::limit($post->excerpt, 80) }}</div>@endif
                    </td>
                    <td class="px-6 py-4 text-gray-400 text-sm">{{ $post->category?->name ?? '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="text-xs px-2.5 py-1 rounded-lg {{ $post->status === 'published' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-gray-500/10 text-gray-400 border border-gray-500/20' }}">{{ ucfirst($post->status) }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-400 text-sm">{{ $post->created_at->format('M j, Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-3">
                            @if($post->status === 'published')
                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="text-gray-500 hover:text-amber-400 transition-colors" title="View"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>
                            @endif
                            <a href="{{ route('admin.blog.edit', $post) }}" class="text-gray-500 hover:text-amber-400 transition-colors" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">@csrf @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors" title="Delete"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-white/5">{{ $posts->links() }}</div>
    @endif
</div>
@endsection
