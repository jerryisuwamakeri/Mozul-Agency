@extends('layouts.admin')
@section('title', 'Courses')

@section('admin-content')

<div class="flex items-center justify-between mb-7">
    <div>
        <h1 class="text-white font-bold text-lg">Courses</h1>
        <p class="text-gray-600 text-xs mt-0.5">{{ $courses->count() }} {{ Str::plural('course', $courses->count()) }}</p>
    </div>
    <a href="{{ route('admin.courses.create') }}"
       class="inline-flex items-center gap-1.5 bg-white text-black text-sm font-bold px-4 py-2.5 rounded-xl hover:bg-gray-100 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        New Course
    </a>
</div>

@if($courses->isEmpty())
<div class="bg-[#13131f] border border-white/5 rounded-2xl flex flex-col items-center justify-center py-20 text-center">
    <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
    </div>
    <p class="text-white font-semibold mb-1">No courses yet</p>
    <p class="text-gray-600 text-sm mb-6">Create your first course to get started.</p>
    <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 bg-white text-black font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-gray-100 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        Create Course
    </a>
</div>
@else
<div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="border-b border-white/5">
                <th class="text-left px-6 py-3.5 text-gray-500 text-xs font-semibold uppercase tracking-widest">Course</th>
                <th class="text-left px-4 py-3.5 text-gray-500 text-xs font-semibold uppercase tracking-widest hidden md:table-cell">Level</th>
                <th class="text-left px-4 py-3.5 text-gray-500 text-xs font-semibold uppercase tracking-widest hidden lg:table-cell">Price</th>
                <th class="text-left px-4 py-3.5 text-gray-500 text-xs font-semibold uppercase tracking-widest">Status</th>
                <th class="px-4 py-3.5 text-right text-gray-500 text-xs font-semibold uppercase tracking-widest">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @foreach($courses as $course)
            <tr class="hover:bg-white/[0.02] transition-colors group">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-9 rounded-lg overflow-hidden bg-white/5 shrink-0">
                            @if($course->cover_image)
                            <img src="{{ Storage::url($course->cover_image) }}" alt="" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <div class="text-white text-sm font-semibold truncate">{{ $course->title }}</div>
                            @if($course->duration)<div class="text-gray-600 text-xs mt-0.5">{{ $course->duration }}</div>@endif
                        </div>
                    </div>
                </td>
                <td class="px-4 py-4 hidden md:table-cell">
                    <span class="text-gray-400 text-sm capitalize">{{ $course->level ?? '—' }}</span>
                </td>
                <td class="px-4 py-4 hidden lg:table-cell">
                    <span class="text-gray-400 text-sm">{{ $course->formatted_price }}</span>
                </td>
                <td class="px-4 py-4">
                    @php $colors = ['published'=>'bg-green-500/10 text-green-400','draft'=>'bg-white/5 text-gray-500','coming_soon'=>'bg-white/10 text-white']; @endphp
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-lg {{ $colors[$course->status] ?? 'bg-white/5 text-gray-500' }}">
                        {{ ucwords(str_replace('_',' ',$course->status)) }}
                    </span>
                </td>
                <td class="px-4 py-4 text-right">
                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.courses.edit', $course) }}"
                           class="inline-flex items-center gap-1 text-xs bg-white/10 hover:bg-white/15 text-white font-medium px-3 py-1.5 rounded-lg transition-colors">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                              onsubmit="return confirm('Delete {{ $course->title }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-400 hover:text-red-300 font-medium px-2 py-1.5 rounded-lg hover:bg-red-400/5 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
