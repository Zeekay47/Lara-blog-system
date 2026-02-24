{{-- resources/views/about.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Learn more about our blog platform and mission.">

        <title>{{ config('app.name', 'BlogSpace') }} - About Us</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased overflow-x-hidden">
        {{-- Animated Background --}}
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute top-40 left-20 w-96 h-96 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-40 right-20 w-96 h-96 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        {{-- Navigation --}}
        <header class="w-full max-w-4xl mx-auto px-6 py-6 flex items-center justify-between animate-slide-down">
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <svg class="w-8 h-8 text-[#f53003] transition-transform duration-500 group-hover:rotate-180" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    <span class="font-bold text-xl gradient-text">{{ config('app.name', 'BlogSpace') }}</span>
                </a>
            </div>
            
            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-5 py-2 border border-[#19140035] hover:border-[#1915014a] rounded-sm text-sm transition-all duration-300 hover:scale-110 hover:shadow-lg relative overflow-hidden group">
                            <span class="relative z-10">Dashboard</span>
                            <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2 text-sm hover:text-[#f53003] transition-all duration-300 hover:scale-110">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-5 py-2 border border-[#19140035] hover:border-[#1915014a] rounded-sm text-sm transition-all duration-300 hover:scale-110 hover:shadow-lg relative overflow-hidden group">
                                <span class="relative z-10">Register</span>
                                <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        {{-- About Hero --}}
        <section class="max-w-4xl mx-auto px-6 py-16 lg:py-20">
            <div data-aos="fade-down" data-aos-duration="800">
                <h1 class="text-4xl lg:text-5xl font-bold mb-6 text-center">
                    About <span class="text-[#f53003] relative inline-block">
                        Our Blog
                        <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 10" preserveAspectRatio="none">
                            <path d="M0,5 Q150,0 300,5" stroke="#f53003" stroke-width="2" fill="none" stroke-dasharray="300" stroke-dashoffset="300">
                                <animate attributeName="stroke-dashoffset" from="300" to="0" dur="2s" fill="freeze" />
                            </path>
                        </svg>
                    </span>
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 text-center max-w-2xl mx-auto mb-12">
                    We're on a mission to create a space where writers and readers can connect through meaningful stories.
                </p>
            </div>

            {{-- Our Story Section --}}
            <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
                <div data-aos="fade-right" data-aos-duration="800">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center gap-2">
                        <span class="w-1 h-8 bg-[#f53003] rounded-full"></span>
                        Our Story
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">
                        Founded in 2026, our blog platform was born from a simple idea: everyone has a story to tell, 
                        and the world deserves to hear it. We started as a small community of writers and have grown 
                        into a vibrant platform where thousands of voices are heard every day.
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Whether you're a seasoned writer or just starting your journey, we provide the tools and 
                        community you need to share your thoughts with the world.
                    </p>
                    
                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-4 mt-8">
                        <div class="text-center group cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                            <div class="text-2xl font-bold text-[#f53003] group-hover:scale-110 transition-transform">10K+</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Writers</div>
                        </div>
                        <div class="text-center group cursor-pointer" data-aos="fade-up" data-aos-delay="150">
                            <div class="text-2xl font-bold text-[#f53003] group-hover:scale-110 transition-transform">50K+</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Blog Posts</div>
                        </div>
                        <div class="text-center group cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                            <div class="text-2xl font-bold text-[#f53003] group-hover:scale-110 transition-transform">100K+</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">Readers</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative" data-aos="fade-left" data-aos-duration="800">
                    <div class="bg-gradient-to-br from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004] rounded-lg p-8 aspect-square flex items-center justify-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                        
                        <svg class="w-48 h-48 text-[#f53003] transition-all duration-500 group-hover:scale-110 group-hover:rotate-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                        
                        {{-- Floating elements --}}
                        <div class="absolute top-10 left-10 w-4 h-4 bg-[#f53003] rounded-full opacity-30 animate-ping"></div>
                        <div class="absolute bottom-10 right-10 w-6 h-6 bg-[#ff8a5c] rounded-full opacity-30 animate-ping" style="animation-delay: 1s;"></div>
                    </div>
                </div>
            </div>

            {{-- Mission & Values --}}
            <div class="grid lg:grid-cols-3 gap-8 mt-16">
                @php
                    $values = [
                        [
                            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                            'title' => 'Our Mission',
                            'description' => 'Empowering voices and connecting communities through authentic storytelling.',
                            'color' => 'from-blue-500 to-purple-600'
                        ],
                        [
                            'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                            'title' => 'Our Values',
                            'description' => 'Authenticity, inclusivity, creativity, and community-first approach.',
                            'color' => 'from-green-500 to-teal-600'
                        ],
                        [
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                            'title' => 'Our Community',
                            'description' => 'A diverse group of writers, readers, and thinkers from around the world.',
                            'color' => 'from-orange-500 to-red-600'
                        ],
                    ];
                @endphp

                @foreach($values as $index => $value)
                <div class="group cursor-pointer"
                     data-aos="fade-up"
                     data-aos-delay="{{ $index * 150 }}">
                    <div class="text-center p-6 bg-white dark:bg-[#161615] rounded-lg shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-4 hover:scale-105 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $value['color'] }} opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                        
                        <div class="relative">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br {{ $value['color'] }} flex items-center justify-center transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $value['icon'] }}"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2 group-hover:text-[#f53003] transition-colors">{{ $value['title'] }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $value['description'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Team Section --}}
            <div class="mt-20">
                <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-down">Meet Our Team</h2>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $team = [
                            ['name' => 'John Doe', 'role' => 'Founder & CEO', 'avatar' => 'JD'],
                            ['name' => 'Jane Smith', 'role' => 'Editor-in-Chief', 'avatar' => 'JS'],
                            ['name' => 'Mike Johnson', 'role' => 'Lead Developer', 'avatar' => 'MJ'],
                            ['name' => 'Sarah Wilson', 'role' => 'Community Manager', 'avatar' => 'SW'],
                        ];
                    @endphp

                    @foreach($team as $index => $member)
                    <div class="group cursor-pointer"
                         data-aos="fade-up"
                         data-aos-delay="{{ $index * 100 }}">
                        <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-4 text-center">
                            <div class="relative inline-block">
                                <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#f53003] to-[#ff8a5c] flex items-center justify-center text-2xl font-bold text-white transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                                    {{ $member['avatar'] }}
                                </div>
                                <span class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 rounded-full ring-2 ring-white dark:ring-[#161615]"></span>
                            </div>
                            <h3 class="font-semibold group-hover:text-[#f53003] transition-colors">{{ $member['name'] }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $member['role'] }}</p>
                            
                            {{-- Social links --}}
                            <div class="flex justify-center gap-2 mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="#" class="p-1 hover:text-[#f53003] transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879v-6.99h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.99C18.343 21.128 22 16.991 22 12z"/>
                                    </svg>
                                </a>
                                <a href="#" class="p-1 hover:text-[#f53003] transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                    </svg>
                                </a>
                                <a href="#" class="p-1 hover:text-[#f53003] transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="max-w-4xl mx-auto px-6 py-8 border-t border-[#e3e3e0] dark:border-[#3E3E3A] mt-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    © {{ date('Y') }} {{ config('app.name', 'BlogSpace') }}. All rights reserved.
                </p>
                <div class="flex gap-6">
                    <a href="{{ url('/about') }}" class="text-sm text-[#f53003] font-medium">About</a>
                    <a href="{{ url('/privacy') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">Privacy</a>
                    <a href="{{ url('/terms') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">Terms</a>
                    <a href="{{ url('/contact') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">Contact</a>
                </div>
            </div>
        </footer>

        <!-- AOS Script -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
    </body>
</html>