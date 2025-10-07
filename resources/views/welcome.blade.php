<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forest Meditation App</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Tailwind CDN for demo (remove if using your own build) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f7faf9] min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-xl shadow p-10 flex flex-col items-center">
        <h1 class="mb-4 text-3xl font-bold text-[#219150] flex items-center gap-2">
            <span>🌲</span>
            Forest Meditation App
        </h1>
        <p class="mb-8 text-base text-[#22543d] text-center">
            Track your meditation walks, listen to guided audio, and reflect with comments.<br>
            Log in or register to start your journey!
        </p>
        <div class="flex gap-4">
            <a href="{{ route('login') }}" class="px-6 py-2 rounded-lg bg-[#e6f4ea] text-[#219150] font-semibold shadow hover:bg-[#d4ede1] transition">
                Login
            </a>
            <a href="{{ route('register') }}" class="px-6 py-2 rounded-lg bg-[#e6f4ea] text-[#219150] font-semibold shadow hover:bg-[#d4ede1] transition">
                Register
            </a>
        </div>
    </div>

</body>
</html>
