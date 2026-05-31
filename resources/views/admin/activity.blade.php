@extends('layouts.admin')
@section('title', 'Activity Log')

@section('admin-content')

<div class="flex items-center justify-between mb-7">
    <div>
        <h1 class="text-white font-bold text-lg">Activity Log</h1>
        <p class="text-gray-600 text-xs mt-0.5">All admin actions, most recent first</p>
    </div>
    <span class="text-gray-700 text-xs">{{ $logs->total() }} total events</span>
</div>

@if($logs->isEmpty())
<div class="bg-[#13131f] border border-white/5 rounded-2xl flex flex-col items-center justify-center py-20 text-center">
    <svg class="w-8 h-8 text-gray-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <p class="text-gray-600 text-sm">No activity logged yet.</p>
    <p class="text-gray-700 text-xs mt-1">Actions will appear here as you use the admin.</p>
</div>
@else

{{-- Timeline feed --}}
<div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
    <div class="divide-y divide-white/5">
        @foreach($logs as $log)
        <div class="flex items-start gap-4 px-6 py-4 hover:bg-white/[0.02] transition-colors">

            {{-- Icon --}}
            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-3.5 h-3.5 {{ $log->action_color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $log->action_icon }}"/>
                </svg>
            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-gray-200 text-sm leading-snug">{{ $log->description }}</p>
                        <div class="flex items-center gap-2 mt-1.5 text-xs text-gray-600">
                            <span class="font-medium text-gray-500">{{ $log->user_name }}</span>
                            @if($log->model_type)
                            <span>·</span>
                            <span class="bg-white/5 px-1.5 py-0.5 rounded text-gray-600 font-mono text-[10px]">{{ $log->model_type }}@if($log->model_id)#{{ $log->model_id }}@endif</span>
                            @endif
                            @if($log->ip_address)
                            <span>·</span>
                            <span class="font-mono text-[10px]">{{ $log->ip_address }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-gray-700 text-xs shrink-0 whitespace-nowrap">
                        <span title="{{ $log->created_at->format('M j, Y H:i:s') }}">{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            {{-- Action badge --}}
            <div class="shrink-0">
                @php $badges = ['created'=>'bg-green-500/10 text-green-400','updated'=>'bg-blue-500/10 text-blue-400','deleted'=>'bg-red-500/10 text-red-400','published'=>'bg-green-500/10 text-green-400','approved'=>'bg-green-500/10 text-green-400','rejected'=>'bg-red-500/10 text-red-400']; @endphp
                <span class="text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider {{ $badges[$log->action] ?? 'bg-white/5 text-gray-500' }}">
                    {{ $log->action }}
                </span>
            </div>

        </div>
        @endforeach
    </div>
</div>

{{-- Pagination --}}
@if($logs->hasPages())
<div class="mt-5 flex justify-center">{{ $logs->links() }}</div>
@endif

@endif
@endsection
