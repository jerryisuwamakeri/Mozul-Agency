@extends('layouts.admin')
@section('title', 'Submission Details')

@section('admin-content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.submissions.index') }}" class="text-gray-400 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-white font-bold text-lg">Submission from {{ $submission->name }}</h2>
    </div>

    <div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-white/5">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 10 rounded-2xl flex items-center justify-center text-amber-400 font-black text-xl">{{ strtoupper(substr($submission->name,0,1)) }}</div>
                <div>
                    <h3 class="text-white font-bold text-xl">{{ $submission->name }}</h3>
                    <p class="text-gray-400 text-sm">{{ $submission->email }}</p>
                </div>
                <span class="ml-auto text-xs text-gray-500">{{ $submission->created_at->format('M j, Y · g:i A') }}</span>
            </div>
        </div>
        <div class="p-6 space-y-4">
            @if($submission->phone)
            <div class="grid grid-cols-3">
                <span class="text-gray-500 text-sm">Phone</span>
                <span class="col-span-2 text-white text-sm">{{ $submission->phone }}</span>
            </div>
            @endif
            @if($submission->company)
            <div class="grid grid-cols-3">
                <span class="text-gray-500 text-sm">Company</span>
                <span class="col-span-2 text-white text-sm">{{ $submission->company }}</span>
            </div>
            @endif
            @if($submission->service_interest)
            <div class="grid grid-cols-3">
                <span class="text-gray-500 text-sm">Service Interest</span>
                <span class="col-span-2"><span class="text-xs 10 text-amber-400 border 20 px-2.5 py-1 rounded-lg">{{ $submission->service_interest }}</span></span>
            </div>
            @endif
            <div class="pt-4 border-t border-white/5">
                <span class="text-gray-500 text-sm block mb-3">Message</span>
                <div class="bg-white/[0.03] rounded-xl p-4 text-gray-300 text-sm leading-relaxed whitespace-pre-wrap">{{ $submission->message }}</div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-white/5 flex justify-between">
            <a href="mailto:{{ $submission->email }}?subject=Re: Your enquiry to Mozul Africa" class="bg-amber-400 text-black font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-amber-300 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Reply by Email
            </a>
            <form method="POST" action="{{ route('admin.submissions.destroy', $submission) }}" onsubmit="return confirm('Delete this submission?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-400 border border-red-400/20 px-5 py-2.5 rounded-xl text-sm hover:bg-red-400/10 transition-colors">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
