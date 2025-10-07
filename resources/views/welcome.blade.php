<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forest Meditation App</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles (Tailwind via CDN for demo, use your build in production) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#e6f4ea] dark:bg-[#254d32] min-h-screen flex flex-col items-center justify-center">

    <!-- Optional: Top-right nav links -->
    <header class="w-full max-w-4xl text-sm mb-6 flex justify-end">
        @if (Route::has('login'))
            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-1.5 rounded-sm border border-[#19140035] text-[#22543d] dark:text-[#EDEDEC] dark:border-[#3E3E3A] hover:border-[#1915014a] dark:hover:border-[#62605b] text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-1.5 rounded-sm border border-transparent text-[#22543d] dark:text-[#EDEDEC] dark:border-[#3E3E3A] hover:border-[#19140035] dark:hover:border-[#62605b] text-sm leading-normal">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-1.5 rounded-sm border border-[#19140035] text-[#22543d] dark:text-[#EDEDEC] dark:border-[#3E3E3A] hover:border-[#1915014a] dark:hover:border-[#62605b] text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Centered Welcome Card -->
    <div class="w-full max-w-lg bg-white/90 dark:bg-[#38755b]/90 rounded-xl shadow-lg p-10 flex flex-col items-center">
        <h1 class="mb-4 text-4xl font-bold text-[#22543d] dark:text-[#e6f4ea]">Welcome to Forest Meditation App</h1>
        <p class="mb-8 text-lg text-[#22543d] dark:text-[#e6f4ea] text-center">
            Track your meditation walks, listen to guided audio, and reflect with comments.<br>
            Log in or register to start your journey!
        </p>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-[#94d3ac] hover:bg-[#6fcf97] text-[#22543d] font-semibold px-6 py-3 rounded-lg transition dark:bg-[#64bb8b] dark:text-[#254d32]">
                Login
            </a>
            <a href="{{ route('register') }}" class="bg-[#b7e4c7] hover:bg-[#94d3ac] text-[#22543d] font-semibold px-6 py-3 rounded-lg transition dark:bg-[#b7e4c7] dark:text-[#254d32]">
                Register
            </a>
        </div>
    </div>
</body>
</html>
