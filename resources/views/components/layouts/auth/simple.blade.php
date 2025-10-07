<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-[#f7faf9] antialiased">
    <div class="flex min-h-screen flex-col items-center justify-center gap-6 p-6">
        <div class="w-full max-w-md">
            <!-- Logo/Brand -->
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 mb-8" wire:navigate>
                <span class="text-5xl">🌲</span>
                <span class="sr-only">{{ config('app.name', 'Forest App') }}</span>
            </a>

            <!-- Auth Card -->
            <div class="bg-white rounded-xl shadow-md border border-[#e6f4ea] p-10">
                @if($title ?? false)
                    <h1 class="text-2xl font-bold text-[#219150] mb-2 text-center">{{ $title }}</h1>
                @endif
                
                {{ $slot }}
            </div>
        </div>
    </div>
    
    @fluxScripts
    
    <style>
        /* Override Flux dark mode */
        html, body {
            color-scheme: light !important;
        }
        
        /* Input fields */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            background-color: #f7faf9 !important;
            border-color: #e6f4ea !important;
            color: #22543d !important;
        }
        
        input:focus {
            border-color: #b7e4c7 !important;
            ring-color: #b7e4c7 !important;
        }
        
        /* Labels */
        label {
            color: #22543d !important;
            font-weight: 500 !important;
        }
        
        /* Buttons */
        button[type="submit"],
        button[variant="primary"] {
            background-color: #e6f4ea !important;
            color: #219150 !important;
            font-weight: 600 !important;
            border: none !important;
        }
        
        button[type="submit"]:hover,
        button[variant="primary"]:hover {
            background-color: #d4ede1 !important;
        }
        
        /* Links */
        a {
            color: #219150 !important;
        }
        
        a:hover {
            color: #1a7a40 !important;
            text-decoration: underline !important;
        }
        
        /* Checkbox */
        input[type="checkbox"]:checked {
            background-color: #219150 !important;
            border-color: #219150 !important;
        }
        
        /* Text colors */
        p, span, div {
            color: #22543d !important;
        }
        
        /* Remove dark mode text */
        .dark\:text-zinc-400,
        .text-zinc-600 {
            color: #22543d !important;
        }
    </style>
</body>
</html>
