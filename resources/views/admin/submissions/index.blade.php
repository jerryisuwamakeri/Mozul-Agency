@extends('layouts.admin')
@section('title', 'Form Submissions')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-white font-bold text-lg">Form Submissions</h2>
        <p class="text-gray-500 text-sm">{{ $submissions->total() }} total · {{ $submissions->where('is_read', false)->count() }} unread</p>
    </div>
</div>

<div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
    @if($submissions->isEmpty())
    <div class="text-center py-16 text-gray-500">No submissions yet.</div>
    @else
    <div class="divide-y divide-white/5">
        @foreach($submissions as $sub)
        <div class="flex items-start gap-4 px-6 py-5 hover:bg-white/[0.02] transition-colors {{ !$sub->is_read ? 'border-l-2 border-amber-400' : '' }}">
            <div class="w-10 h-10 10 rounded-full flex items-center justify-center text-amber-400 font-bold text-sm shrink-0">{{ strtoupper(substr($sub->name,0,1)) }}</div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="text-white font-semibold text-sm">{{ $sub->name }}</span>
                    @if(!$sub->is_read)<span class="text-xs bg-amber-400 text-black font-bold px-2 py-0.5 rounded-full">New</span>@endif
                    @if($sub->service_interest)<span class="text-xs bg-white/10 text-gray-300 px-2 py-0.5 rounded-full">{{ $sub->service_interest }}</span>@endif
                </div>
                <div class="flex items-center gap-3 mt-1 text-sm text-gray-400">
                    <span>{{ $sub->email }}</span>
                    @if($sub->phone)<span>·</span><span>{{ $sub->phone }}</span>@endif
                    @if($sub->company)<span>·</span><span>{{ $sub->company }}</span>@endif
                </div>
                <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $sub->message }}</p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <span class="text-gray-600 text-xs">{{ $sub->created_at->diffForHumans() }}</span>
                <a href="{{ route('admin.submissions.show', $sub) }}" class="text-amber-400 hover:text-amber-300 text-xs font-medium">View</a>
                <form method="POST" action="{{ route('admin.submissions.destroy', $sub) }}" onsubmit="return confirm('Delete this submission?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <div class="px-6 py-4 border-t border-white/5">{{ $submissions->links() }}</div>
    @endif
</div>
@endsection
