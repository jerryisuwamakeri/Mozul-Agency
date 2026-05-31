@extends('layouts.admin')
@section('title', 'Reviews')

@section('admin-content')
<div class="grid lg:grid-cols-3 gap-6">
    {{-- Add Review --}}
    <div class="bg-[#13131f] border border-white/5 rounded-2xl p-6">
        <h2 class="text-white font-bold mb-5">Add Review</h2>
        <form method="POST" action="{{ route('admin.reviews.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:50 transition" placeholder="Client name">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Company</label>
                <input type="text" name="company" value="{{ old('company') }}" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:50 transition" placeholder="Company name">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Position</label>
                <input type="text" name="position" value="{{ old('position') }}" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:50 transition" placeholder="CEO, Marketing Manager...">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Review *</label>
                <textarea name="content" rows="4" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:50 transition resize-none" placeholder="Review content...">{{ old('content') }}</textarea>
                @error('content')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1.5">Rating</label>
                <select name="rating" class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:50 transition">
                    @for($i=5;$i>=1;$i--)<option value="{{ $i }}" {{ old('rating',5)==$i?'selected':'' }}>{{ $i }} star{{ $i>1?'s':'' }}</option>@endfor
                </select>
            </div>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 text-sm text-gray-400 cursor-pointer">
                    <input type="checkbox" name="is_approved" value="1" {{ old('is_approved') ? 'checked' : '' }} class="rounded border-white/20 bg-white/5 text-amber-400">
                    Approved
                </label>
                <label class="flex items-center gap-2 text-sm text-gray-400 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-white/20 bg-white/5 text-amber-400">
                    Featured
                </label>
            </div>
            <button type="submit" class="w-full bg-amber-400 text-black font-bold py-3 rounded-xl text-sm hover:bg-amber-300 transition-colors">Add Review</button>
        </form>
    </div>

    {{-- Reviews list --}}
    <div class="lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-white font-bold">All Reviews ({{ $reviews->total() }})</h2>
        </div>
        <div class="space-y-4">
            @if($reviews->isEmpty())
            <div class="bg-[#13131f] border border-white/5 rounded-2xl p-10 text-center text-gray-500">No reviews yet.</div>
            @else
            @foreach($reviews as $review)
            <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <span class="text-white font-semibold text-sm">{{ $review->name }}</span>
                            @if($review->is_approved)<span class="text-xs bg-green-500/10 text-green-400 border border-green-500/20 px-2 py-0.5 rounded-full">Approved</span>@else<span class="text-xs bg-gray-500/10 text-gray-400 border border-gray-500/20 px-2 py-0.5 rounded-full">Pending</span>@endif
                            @if($review->is_featured)<span class="text-xs 10 text-amber-400 border 20 px-2 py-0.5 rounded-full">Featured</span>@endif
                        </div>
                        @if($review->company || $review->position)<p class="text-gray-500 text-xs mb-2">{{ $review->position ? $review->position.', ':'' }}{{ $review->company }}</p>@endif
                        <div class="flex gap-0.5 mb-2">@for($i=1;$i<=5;$i++)<svg class="w-3.5 h-3.5 {{ $i<=$review->rating?'text-amber-400':'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor</div>
                        <p class="text-gray-400 text-sm">{{ $review->content }}</p>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <form method="POST" action="{{ route('admin.reviews.update', $review) }}">
                            @csrf @method('PUT')
                            <input type="hidden" name="is_approved" value="{{ $review->is_approved ? 0 : 1 }}">
                            <input type="hidden" name="is_featured" value="{{ $review->is_featured ? 1 : 0 }}">
                            <button type="submit" class="text-xs px-2.5 py-1.5 rounded-lg {{ $review->is_approved ? 'bg-red-500/10 text-red-400 hover:bg-red-500/20' : 'bg-green-500/10 text-green-400 hover:bg-green-500/20' }} transition-colors">
                                {{ $review->is_approved ? 'Unapprove' : 'Approve' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.reviews.update', $review) }}">
                            @csrf @method('PUT')
                            <input type="hidden" name="is_approved" value="{{ $review->is_approved ? 1 : 0 }}">
                            <input type="hidden" name="is_featured" value="{{ $review->is_featured ? 0 : 1 }}">
                            <button type="submit" class="text-xs px-2.5 py-1.5 rounded-lg 10 text-amber-400 hover:20 transition-colors">
                                {{ $review->is_featured ? 'Unfeature' : 'Feature' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors p-1.5 rounded-lg hover:bg-red-400/10"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <div>{{ $reviews->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
