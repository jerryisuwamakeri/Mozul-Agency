@extends('layouts.admin')
@section('title', 'Settings')

@section('admin-content')
<div class="max-w-3xl space-y-8">

    {{-- Site Settings --}}
    <div>
        <div class="mb-5">
            <h2 class="text-white font-bold text-lg">Site Settings</h2>
            <p class="text-gray-500 text-sm mt-1">Manage your website content and configuration.</p>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf @method('PUT')
            <div class="space-y-5">
                @foreach($settings as $group => $groupSettings)
                <div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-white/5">
                        <h3 class="text-white font-semibold capitalize text-sm">{{ $group }} Settings</h3>
                    </div>
                    <div class="p-6 space-y-5">
                        @foreach($groupSettings as $setting)
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1.5">{{ $setting->label }}</label>
                            @if($setting->type === 'textarea')
                            <textarea name="{{ $setting->key }}" rows="3"
                                      class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/10 transition resize-none placeholder-gray-600">{{ $setting->value }}</textarea>
                            @elseif($setting->type === 'boolean')
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="{{ $setting->key }}" value="1" {{ $setting->value ? 'checked' : '' }}
                                       class="rounded border-white/20 bg-white/5 text-white focus:ring-white">
                                <span class="text-gray-400 text-sm">Enable</span>
                            </label>
                            @else
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                   class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/10 transition placeholder-gray-600">
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-5 flex justify-end">
                <button type="submit" class="bg-white text-black font-bold px-8 py-3 rounded-xl hover:bg-gray-100 transition-colors">
                    Save Settings
                </button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div>
        <div class="mb-5">
            <h2 class="text-white font-bold text-lg">Change Password</h2>
            <p class="text-gray-500 text-sm mt-1">Update your admin account password.</p>
        </div>

        @if(session('password_success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl px-4 py-3 mb-5 text-sm">
            {{ session('password_success') }}
        </div>
        @endif
        @if(session('password_error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl px-4 py-3 mb-5 text-sm">
            {{ session('password_error') }}
        </div>
        @endif

        <div class="bg-[#13131f] border border-white/5 rounded-2xl overflow-hidden">
            <div class="p-6">
                <form method="POST" action="{{ route('admin.settings.password') }}" class="space-y-5">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1.5">Current Password</label>
                        <input type="password" name="current_password" required
                               class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/10 transition"
                               placeholder="Enter current password">
                        @error('current_password')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1.5">New Password</label>
                            <input type="password" name="password" required
                                   class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/10 transition"
                                   placeholder="Minimum 8 characters">
                            @error('password')<p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1.5">Confirm New Password</label>
                            <input type="password" name="password_confirmation" required
                                   class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/10 transition"
                                   placeholder="Repeat new password">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-white text-black font-bold px-8 py-3 rounded-xl hover:bg-gray-100 transition-colors">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
