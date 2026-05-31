<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — Mozul Africa</title>
    <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f5f5f5] font-sans flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm px-4">

        <div class="text-center mb-8">
            <img src="{{ asset('Logo.png') }}" alt="Mozul Africa" class="h-14 w-auto mx-auto mb-6">
            <h1 class="text-gray-900 font-bold text-2xl">Admin Login</h1>
            <p class="text-gray-500 text-sm mt-1">Sign in to your dashboard</p>
        </div>

        @if(session('status'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-3 mb-5 text-sm">{{ session('status') }}</div>
        @endif

        <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition placeholder-gray-400"
                           placeholder="admin@mozulafrica.com">
                    @error('email')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition"
                           placeholder="••••••••">
                    @error('password')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-black focus:ring-black">
                        Remember me
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-black transition-colors">Forgot password?</a>
                    @endif
                </div>
                <button type="submit" class="w-full bg-black text-white font-bold py-3.5 rounded-xl hover:bg-gray-800 transition-colors">
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-400 text-sm hover:text-black transition-colors">← Back to website</a>
        </p>
    </div>
</body>
</html>
