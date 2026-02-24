{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BlogSpace') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- AOS (Animate On Scroll) -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]"
          x-data="{ 
            loaded: false,
            darkMode: localStorage.getItem('darkMode') === 'true',
            toggleDarkMode() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode);
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
          }"
          x-init="
            loaded = true;
            if (darkMode) document.documentElement.classList.add('dark');
            AOS.init({
                duration: 800,
                once: true,
                offset: 100,
                easing: 'ease-in-out'
            });
          "
          :class="{ 'opacity-0': !loaded, 'opacity-100 transition-opacity duration-500': loaded }">
        
        {{-- Animated Background --}}
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            {{-- Back to home link with animation --}}
            <div class="w-full sm:max-w-md px-4 mb-4 animate-slide-down">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-all duration-300 hover:scale-105 group">
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to home
                </a>
            </div>

            {{-- Main Content Card with Animation --}}
            <div class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg relative overflow-hidden group"
                 data-aos="fade-up"
                 data-aos-duration="800">
                
                {{-- Animated gradient overlay --}}
                <div class="absolute inset-0 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
                
                {{-- Floating particles --}}
                <div class="absolute -top-4 -right-4 w-12 h-12 bg-[#f53003] rounded-full opacity-10 animate-pulse"></div>
                <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-[#ff8a5c] rounded-full opacity-10 animate-pulse" style="animation-delay: 1s;"></div>
                
                {{-- Content --}}
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>

            {{-- Footer with animation --}}
            <div class="w-full sm:max-w-md px-4 mt-8 text-center text-xs text-[#706f6c] dark:text-[#A1A09A] animate-fade-in"
                 data-aos="fade-up"
                 data-aos-delay="200">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'BlogSpace') }}. All rights reserved.</p>
            </div>
        </div>

        {{-- Initialize AOS --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                AOS.init();
            });
        </script>
    </body>
</html>