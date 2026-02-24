{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="A modern blog platform where you can read, write, and share your thoughts with the world.">

        <title>{{ config('app.name', 'Laravel Blog') }} - Share Your Stories</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased overflow-x-hidden">
        {{-- Animated background particles --}}
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-500 opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        </div>

        {{-- Navigation with animation --}}
        <header class="w-full max-w-7xl mx-auto px-6 py-6 flex items-center justify-between animate-slide-down">
            <div class="flex items-center gap-2 group">
                <svg class="w-8 h-8 text-[#f53003] transition-transform duration-500 group-hover:rotate-180" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                <span class="font-bold text-xl gradient-text">{{ config('app.name', 'BlogSpace') }}</span>
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

        {{-- Hero Section with Parallax --}}
        <section class="max-w-7xl mx-auto px-6 py-16 lg:py-24 relative">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                        Share Your Stories<br>
                        <span class="text-[#f53003] relative inline-block">
                            With The World
                            <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 10" preserveAspectRatio="none">
                                <path d="M0,5 Q150,0 300,5" stroke="#f53003" stroke-width="2" fill="none" stroke-dasharray="300" stroke-dashoffset="300">
                                    <animate attributeName="stroke-dashoffset" from="300" to="0" dur="2s" fill="freeze" />
                                </path>
                            </svg>
                        </span>
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                        A modern blog platform where you can read, write, and share your thoughts. 
                        Join our community of writers and readers today.
                    </p>
                    <div class="flex gap-4" data-aos="fade-up" data-aos-delay="300">
                        @auth
                            <a href="{{ route('posts.index') }}" 
                               class="px-6 py-3 bg-[#1b1b18] text-white rounded-sm hover:bg-black transition-all duration-300 hover:scale-110 hover:shadow-xl relative overflow-hidden group">
                                <span class="relative z-10">Browse Blogs</span>
                                <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            </a>
                            <a href="{{ route('posts.create') }}" 
                               class="px-6 py-3 border border-[#19140035] rounded-sm hover:border-[#1915014a] transition-all duration-300 hover:scale-110 hover:shadow-xl">
                                Write a Post
                            </a>
                        @else
                            <a href="{{ route('register') }}" 
                               class="px-6 py-3 bg-[#1b1b18] text-white rounded-sm hover:bg-black transition-all duration-300 hover:scale-110 hover:shadow-xl relative overflow-hidden group">
                                <span class="relative z-10">Start Writing</span>
                                <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            </a>
                            <a href="#featured-blogs" 
                               class="px-6 py-3 border border-[#19140035] rounded-sm hover:border-[#1915014a] transition-all duration-300 hover:scale-110 hover:shadow-xl">
                                Read Blogs
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="relative" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg p-8 aspect-square flex items-center justify-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                        <svg class="w-full h-full text-[#f53003] transition-all duration-500 group-hover:scale-110 group-hover:rotate-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M4 6h16v2H4V6zm2-4h12v2H6V2zm16 7v12H2V9h20zm-2 2H4v8h16v-8zM7 13h4v2H7v-2zm6 0h4v2h-4v-2z"/>
                        </svg>
                        
                        {{-- Floating elements --}}
                        <div class="absolute -top-4 -right-4 w-12 h-12 bg-[#f53003] rounded-full opacity-20 animate-pulse"></div>
                        <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-[#ff8a5c] rounded-full opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Featured Blogs Section with Staggered Cards --}}
        @php
            $featuredBlogs = App\Models\Post::with('user')
                                ->latest()
                                ->take(3)
                                ->get();
        @endphp

        @if($featuredBlogs->count() > 0)
        <section id="featured-blogs" class="max-w-7xl mx-auto px-6 py-16 bg-gray-50 dark:bg-gray-900 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-5"></div>
            
            <h2 class="text-3xl font-bold mb-2" data-aos="fade-down">Latest Stories</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8" data-aos="fade-down" data-aos-delay="100">Discover what our community is writing about</p>
            
            <div class="grid lg:grid-cols-3 gap-8">
                @foreach($featuredBlogs as $index => $blog)
                <article class="bg-white dark:bg-[#161615] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-4 group"
                         data-aos="fade-up"
                         data-aos-delay="{{ $index * 150 }}">
                    <div class="relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                        
                        {{-- Animated image placeholder --}}
                        <div class="h-48 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] opacity-20 group-hover:scale-110 transition-transform duration-500"></div>
                        
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#f53003] to-[#ff8a5c] flex items-center justify-center transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                                        <span class="text-white font-semibold">
                                            {{ substr($blog->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <span class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full ring-2 ring-white dark:ring-[#161615]"></span>
                                </div>
                                <div>
                                    <p class="font-medium group-hover:text-[#f53003] transition-colors">{{ $blog->user->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $blog->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-semibold mb-2 line-clamp-2">
                                <a href="{{ route('posts.show', $blog) }}" class="hover:text-[#f53003] transition-all duration-300 hover:translate-x-1 inline-block">
                                    {{ $blog->title }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                                {{ Str::limit($blog->content, 150) }}
                            </p>
                            
                            <a href="{{ route('posts.show', $blog) }}" 
                               class="inline-flex items-center gap-1 text-[#f53003] hover:gap-3 transition-all duration-300 group/link">
                                Read More
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            
            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('posts.index') }}" 
                   class="inline-block px-6 py-3 border border-[#19140035] rounded-sm hover:border-[#1915014a] transition-all duration-300 hover:scale-110 hover:shadow-xl relative overflow-hidden group">
                    <span class="relative z-10">View All Blogs →</span>
                    <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>
                </a>
            </div>
        </section>
        @endif

        {{-- Features Section with Hover Effects --}}
        <section class="max-w-7xl mx-auto px-6 py-16">
            <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-down">Why Choose Our Blog Platform?</h2>
            
            <div class="grid lg:grid-cols-3 gap-8">
                @php
                    $features = [
                        [
                            'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
                            'title' => 'Write & Edit',
                            'description' => 'Create beautiful blog posts with our easy-to-use editor',
                            'color' => 'from-blue-500 to-purple-600'
                        ],
                        [
                            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                            'title' => 'Connect',
                            'description' => 'Engage with other writers and readers in the community',
                            'color' => 'from-green-500 to-teal-600'
                        ],
                        [
                            'icon' => 'M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z',
                            'title' => 'Save Favorites',
                            'description' => 'Bookmark your favorite posts and read them later',
                            'color' => 'from-orange-500 to-red-600'
                        ],
                    ];
                @endphp

                @foreach($features as $index => $feature)
                <div class="group cursor-pointer"
                     data-aos="fade-up"
                     data-aos-delay="{{ $index * 100 }}">
                    <div class="text-center p-6 bg-white dark:bg-[#161615] rounded-lg shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-4 hover:scale-105">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br {{ $feature['color'] }} flex items-center justify-center transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 group-hover:text-[#f53003] transition-colors">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $feature['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Call to Action with Parallax --}}
        <section class="max-w-4xl mx-auto px-6 py-16 text-center" data-aos="zoom-in">
            <div class="bg-gradient-to-br from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004] rounded-2xl p-12 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-10"></div>
                
                {{-- Animated background shapes --}}
                <div class="absolute top-0 left-0 w-32 h-32 bg-[#f53003] rounded-full opacity-20 animate-pulse"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-[#ff8a5c] rounded-full opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
                
                <h2 class="text-3xl font-bold mb-4 relative z-10">Ready to Start Writing?</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto relative z-10">
                    Join our community of writers today and share your stories with the world.
                </p>
                @auth
                    <a href="{{ route('posts.create') }}" 
                       class="inline-block px-8 py-4 bg-[#1b1b18] text-white rounded-sm hover:bg-black transition-all duration-300 hover:scale-110 hover:shadow-xl relative overflow-hidden group">
                        <span class="relative z-10">Create Your First Post</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                @else
                    <a href="{{ route('register') }}" 
                       class="inline-block px-8 py-4 bg-[#1b1b18] text-white rounded-sm hover:bg-black transition-all duration-300 hover:scale-110 hover:shadow-xl relative overflow-hidden group">
                        <span class="relative z-10">Get Started Now</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                @endauth
            </div>
        </section>

        {{-- Footer with Animation --}}
        <footer class="max-w-7xl mx-auto px-6 py-8 border-t border-[#e3e3e0] dark:border-[#3E3E3A] mt-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    © {{ date('Y') }} {{ config('app.name', 'BlogSpace') }}. All rights reserved.
                </p>
                <div class="flex gap-6">
                    @php
                        $footerLinks = [
                            ['route' => 'about', 'label' => 'About'],
                            ['route' => 'privacy', 'label' => 'Privacy'],
                            ['route' => 'terms', 'label' => 'Terms'],
                            ['route' => 'contact', 'label' => 'Contact'],
                        ];
                    @endphp

                    @foreach($footerLinks as $link)
                    <a href="{{ route($link['route']) }}" 
                       class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">
                        {{ $link['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </footer>
    </body>

    {{-- Initialize AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-in-out'
        });
    </script>
</html>