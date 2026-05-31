<div class="max-w-5xl">

    <div class="flex items-center gap-3 mb-7">
        <a href="{{ route('admin.courses.index') }}" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center text-gray-400 hover:text-white transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-white font-bold text-lg">{{ isset($course) && $course ? 'Edit Course' : 'New Course' }}</h1>
            @if(isset($course) && $course)
            <p class="text-gray-600 text-xs mt-0.5 truncate max-w-xs">{{ $course->title }}</p>
            @endif
        </div>
    </div>

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf
        @if($method === 'PUT') @method('PUT') @endif

        <div class="grid lg:grid-cols-3 gap-5">

            {{-- Main --}}
            <div class="lg:col-span-2 space-y-5">

                <div class="bg-[#13131f] border border-white/5 rounded-2xl p-6 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Course Title *</label>
                        <input type="text" name="title" value="{{ old('title', $course->title ?? '') }}" required
                               class="w-full bg-transparent border-0 border-b border-white/10 text-white text-xl font-bold focus:outline-none focus:border-white/30 transition pb-2 placeholder-gray-700"
                               placeholder="What will students learn?">
                        @error('title')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Short Description</label>
                        <textarea name="description" rows="3"
                                  class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition resize-none placeholder-gray-700"
                                  placeholder="Briefly describe what this course covers and who it's for...">{{ old('description', $course->description ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Full Content / Curriculum</label>
                        <textarea name="content" rows="6"
                                  class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition resize-y placeholder-gray-700 font-mono"
                                  placeholder="Detailed curriculum, what's included, modules...">{{ old('content', $course->content ?? '') }}</textarea>
                    </div>
                </div>

                <div class="bg-[#13131f] border border-white/5 rounded-2xl p-6 space-y-4">
                    <h3 class="text-white font-semibold text-sm">Pricing & Details</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Price</label>
                            <div class="flex">
                                <select name="currency" class="bg-white/5 border border-white/10 border-r-0 text-gray-400 rounded-l-xl px-3 text-sm focus:outline-none focus:border-white/30 transition">
                                    @foreach(['NGN','USD','GBP','EUR','GHS','KES','ZAR'] as $cur)
                                    <option value="{{ $cur }}" {{ old('currency', $course->currency ?? 'NGN') === $cur ? 'selected' : '' }}>{{ $cur }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="price" value="{{ old('price', $course->price ?? '') }}" min="0" step="0.01"
                                       class="flex-1 bg-white/5 border border-white/10 text-white rounded-r-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition placeholder-gray-700"
                                       placeholder="Leave blank for Free">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Duration</label>
                            <input type="text" name="duration" value="{{ old('duration', $course->duration ?? '') }}"
                                   class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition placeholder-gray-700"
                                   placeholder="e.g. 6 weeks, 4 hours">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Level</label>
                            <select name="level" class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition">
                                <option value="">Any level</option>
                                @foreach(['beginner','intermediate','advanced'] as $l)
                                <option value="{{ $l }}" {{ old('level', $course->level ?? '') === $l ? 'selected' : '' }}>{{ ucfirst($l) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Category</label>
                            <input type="text" name="category" value="{{ old('category', $course->category ?? '') }}"
                                   class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition placeholder-gray-700"
                                   placeholder="e.g. Digital Strategy">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Enrollment URL <span class="normal-case text-gray-600 font-normal">(external link, optional)</span></label>
                        <input type="url" name="enrollment_url" value="{{ old('enrollment_url', $course->enrollment_url ?? '') }}"
                               class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition placeholder-gray-700"
                               placeholder="https://...">
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">

                <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5 space-y-4">
                    <h3 class="text-white font-semibold text-sm">Publish</h3>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Status</label>
                        <select name="status" class="w-full bg-white/5 border border-white/10 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition">
                            <option value="draft"       {{ old('status', $course->status ?? 'draft') === 'draft'       ? 'selected' : '' }}>Draft</option>
                            <option value="coming_soon" {{ old('status', $course->status ?? '') === 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                            <option value="published"   {{ old('status', $course->status ?? '') === 'published'   ? 'selected' : '' }}>Published</option>
                        </select>
                        <p class="text-gray-700 text-xs mt-1.5">Only "Published" and "Coming Soon" are visible on the site.</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $course->order ?? 0) }}" min="0"
                               class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 transition">
                        <p class="text-gray-700 text-xs mt-1.5">Lower numbers appear first.</p>
                    </div>
                    <div class="pt-2 flex flex-col gap-2">
                        <button type="submit" class="w-full bg-white hover:bg-gray-100 text-black font-bold py-3 rounded-xl text-sm transition-colors">
                            {{ isset($course) && $course ? 'Save Changes' : 'Create Course' }}
                        </button>
                        <a href="{{ route('admin.courses.index') }}" class="w-full text-center bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 py-3 rounded-xl text-sm transition-colors">Cancel</a>
                    </div>
                    @if(isset($course) && $course)
                    <div class="pt-3 border-t border-white/5">
                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Delete this course permanently?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full text-red-400 hover:text-red-300 text-xs font-semibold py-2 transition-colors">Delete course</button>
                        </form>
                    </div>
                    @endif
                </div>

                {{-- Cover image --}}
                <div class="bg-[#13131f] border border-white/5 rounded-2xl p-5"
                     x-data="{preview: '{{ (isset($course) && $course && $course->cover_image) ? Storage::url($course->cover_image) : '' }}'}">
                    <h3 class="text-white font-semibold text-sm mb-4">Cover Image</h3>
                    <label class="block cursor-pointer">
                        <input type="file" name="cover_image" accept="image/*" class="hidden"
                               @change="preview = URL.createObjectURL($event.target.files[0])">
                        <div x-show="!preview" class="border border-dashed border-white/15 rounded-xl p-8 text-center hover:border-white/30 transition-colors">
                            <svg class="w-7 h-7 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-gray-500 text-xs font-medium">Click to upload</p>
                            <p class="text-gray-700 text-xs mt-0.5">PNG, JPG — max 3MB</p>
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
