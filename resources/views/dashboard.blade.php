{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    @php
        $hour = now()->format('H');
        if ($hour < 12) {
            $greeting = 'Good Morning';
        } elseif ($hour < 18) {
            $greeting = 'Good Afternoon';
        } else {
            $greeting = 'Good Evening';
        }
    @endphp

    <div class="space-y-8" x-data="{ 
        statsLoaded: false,
        showWelcome: true,
        greeting: '{{ $greeting }}'
    }" 
    x-init="
        setTimeout(() => { statsLoaded = true }, 100);
        setTimeout(() => { showWelcome = false }, 5000);
    ">
        {{-- Animated Welcome Banner --}}
        <div x-show="showWelcome" 
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="bg-gradient-to-r from-[#f53003] to-[#ff8a5c] rounded-lg p-4 mb-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center animate-pulse">
                        @php
                            $icon = $hour < 12 ? 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' : ($hour < 18 ? 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z' : 'M20 12H4M12 4v16');
                        @endphp
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold"><span x-text="greeting"></span>, {{ auth()->user()->name }}! 👋</p>
                        <p class="text-sm text-white text-opacity-90">Welcome back to your dashboard</p>
                    </div>
                </div>
                <button @click="showWelcome = false" class="text-white hover:text-white text-opacity-80 transition-opacity">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Page Header with Animated Gradient Text --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-[#f53003] to-[#ff8a5c] bg-clip-text text-transparent animate-gradient">
                    Dashboard
                </h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1 flex items-center gap-2">
                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    Welcome back, <span class="font-medium text-[#f53003] relative group">
                        {{ auth()->user()->name }}
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#f53003] transition-all duration-300 group-hover:w-full"></span>
                    </span>
                </p>
            </div>
            
            {{-- Quick Stats Badge --}}
            <div class="flex gap-2">
                <div class="px-3 py-1 bg-[#fff2f2] dark:bg-[#1D0002] rounded-full text-sm text-[#f53003] flex items-center gap-1 hover:scale-105 transition-transform duration-300 cursor-default">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    {{ $myPosts->count() }} Total Posts
                </div>
                <div class="px-3 py-1 bg-[#fff2f2] dark:bg-[#1D0002] rounded-full text-sm text-[#f53003] flex items-center gap-1 hover:scale-105 transition-transform duration-300 cursor-default">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Joined {{ auth()->user()->created_at->format('M Y') }}
                </div>
            </div>
        </div>

        {{-- Stats Cards with Staggered Entrance Animations --}}
        <div class="grid md:grid-cols-3 gap-6">
            {{-- Total Blogs Card --}}
            <div x-show="statsLoaded"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:enter-delay="100"
                 class="bg-white dark:bg-[#161615] p-6 rounded-xl shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group relative overflow-hidden">
                
                {{-- Animated Background Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-br from-[#f53003]/5 to-[#ff8a5c]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <span class="text-xs text-[#706f6c] dark:text-[#A1A09A] bg-[#fff2f2] dark:bg-[#1D0002] px-2 py-1 rounded-full">Total count</span>
                    </div>
                    <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mb-1">My Total Blogs</p>
                    <div class="flex items-end gap-2">
                        <h2 class="text-4xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-[#f53003] transition-colors duration-300 tabular-nums">
                            {{ $myTotalPosts }}
                        </h2>
                        <span class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-1">posts</span>
                    </div>
                    
                    {{-- Progress Bar --}}
                    <div class="mt-4 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#f53003] to-[#ff8a5c] rounded-full transition-all duration-1000"
                             :style="{ width: '{{ min(($myTotalPosts / 10) * 100, 100) }}%' }"></div>
                    </div>
                </div>
            </div>

            {{-- Latest Blog Card --}}
            <div x-show="statsLoaded"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:enter-delay="200"
                 class="bg-white dark:bg-[#161615] p-6 rounded-xl shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group relative overflow-hidden">
                
                <div class="absolute inset-0 bg-gradient-to-br from-[#f53003]/5 to-[#ff8a5c]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs text-[#706f6c] dark:text-[#A1A09A] bg-[#fff2f2] dark:bg-[#1D0002] px-2 py-1 rounded-full">Most recent</span>
                    </div>
                    <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mb-1">Latest Blog</p>
                    
                    @if($latestPost)
                        <h2 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] truncate group-hover:text-[#f53003] transition-colors duration-300 mb-1">
                            {{ $latestPost->title }}
                        </h2>
                        <div class="flex items-center gap-2 text-xs text-[#706f6c] dark:text-[#A1A09A]">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $latestPost->created_at->diffForHumans() }}
                        </div>
                        
                        {{-- Preview Indicator --}}
                        <div class="mt-3 flex items-center gap-1">
                            <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Published</span>
                        </div>
                    @else
                        <div class="flex items-center gap-2 py-2">
                            <div class="w-8 h-8 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-[#706f6c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-[#706f6c] dark:text-[#A1A09A]">
                                    No posts yet
                                </h2>
                                <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Create your first blog post</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Account Status Card --}}
            <div x-show="statsLoaded"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:enter-delay="300"
                 class="bg-white dark:bg-[#161615] p-6 rounded-xl shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group relative overflow-hidden">
                
                <div class="absolute inset-0 bg-gradient-to-br from-[#f53003]/5 to-[#ff8a5c]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <span class="text-xs text-[#706f6c] dark:text-[#A1A09A] bg-[#fff2f2] dark:bg-[#1D0002] px-2 py-1 rounded-full">Membership</span>
                    </div>
                    <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mb-1">Account Status</p>
                    
                    <div class="flex items-center gap-3 mb-2">
                        <div class="flex items-center gap-2">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                            <h2 class="text-lg font-semibold text-green-600 dark:text-green-400">
                                Active
                            </h2>
                        </div>
                        <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 rounded-full">Premium</span>
                    </div>
                    
                    <div class="flex items-center gap-2 text-xs text-[#706f6c] dark:text-[#A1A09A]">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Member since {{ auth()->user()->created_at->format('M Y') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Action Cards with 3D Hover Effects --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $actions = [
                    ['route' => 'posts.index', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'label' => 'Browse All', 'color' => 'from-blue-500 to-cyan-500'],
                    ['route' => 'posts.my', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'label' => 'My Blogs', 'color' => 'from-purple-500 to-pink-500'],
                    ['route' => 'posts.create', 'icon' => 'M12 4v16m8-8H4', 'label' => 'Create New', 'color' => 'from-green-500 to-emerald-500'],
                    ['route' => 'posts.index', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z', 'label' => 'Categories', 'color' => 'from-orange-500 to-red-500'],
                ];
            @endphp

            @foreach($actions as $index => $action)
            <a href="{{ route($action['route']) }}" 
               x-show="statsLoaded"
               x-transition:enter="transition ease-out duration-500"
               x-transition:enter-start="opacity-0 transform scale-90"
               x-transition:enter-end="opacity-100 transform scale-100"
               x-transition:enter-delay="{{ 400 + ($index * 50) }}"
               class="group relative perspective">
                <div class="bg-white dark:bg-[#161615] p-4 rounded-xl shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:rotate-1 text-center relative overflow-hidden transform-gpu preserve-3d">
                    
                    {{-- Animated gradient background --}}
                    <div class="absolute inset-0 bg-gradient-to-br {{ $action['color'] }} opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    
                    {{-- Icon container with floating animation --}}
                    <div class="relative">
                        <div class="w-14 h-14 mx-auto mb-3 rounded-xl bg-gradient-to-br {{ $action['color'] }} flex items-center justify-center transform transition-all duration-500 group-hover:scale-125 group-hover:rotate-12 group-hover:shadow-xl animate-float" 
                             style="animation-delay: {{ $index * 0.2 }}s">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"/>
                            </svg>
                        </div>
                        
                        {{-- Label with underline animation --}}
                        <span class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-[#f53003] transition-colors duration-300 relative">
                            {{ $action['label'] }}
                            <span class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-[#f53003] transform -translate-x-1/2 transition-all duration-300 group-hover:w-1/2"></span>
                        </span>
                        
                        {{-- Shine effect --}}
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none">
                            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-transparent via-white to-transparent -skew-x-12 animate-shine"></div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Recent Blogs Table with Row Animations --}}
        <div x-show="statsLoaded"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:enter-delay="600"
             class="bg-white dark:bg-[#161615] rounded-xl shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] overflow-hidden">
            
            {{-- Table Header with Gradient --}}
            <div class="p-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-gradient-to-r from-[#fff2f2] to-transparent dark:from-[#1D0002]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                                Recent Blogs
                            </h3>
                            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Your latest published posts</p>
                        </div>
                    </div>
                    
                    {{-- View All Button with Animation --}}
                    <a href="{{ route('posts.index') }}" 
                       class="group flex items-center gap-2 px-4 py-2 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg hover:bg-[#f53003] hover:text-white transition-all duration-300">
                        <span class="text-sm font-medium">View all</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                @if($myPosts->count() > 0)
                    <table class="min-w-full text-sm">
                        <thead class="bg-[#fff2f2] dark:bg-[#1D0002]">
                            <tr>
                                <th class="text-left px-6 py-3 text-xs font-medium text-[#706f6c] dark:text-[#A1A09A] uppercase tracking-wider">Title</th>
                                <th class="text-left px-6 py-3 text-xs font-medium text-[#706f6c] dark:text-[#A1A09A] uppercase tracking-wider">Author</th>
                                <th class="text-left px-6 py-3 text-xs font-medium text-[#706f6c] dark:text-[#A1A09A] uppercase tracking-wider">Published</th>
                                <th class="text-right px-6 py-3 text-xs font-medium text-[#706f6c] dark:text-[#A1A09A] uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                            @foreach($myPosts as $index => $post)
                                <tr class="hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] transition-all duration-300 hover:scale-[1.01] hover:shadow-lg cursor-pointer group"
                                    x-data="{ showActions: false }"
                                    @mouseenter="showActions = true"
                                    @mouseleave="showActions = false"
                                    style="animation-delay: {{ $index * 50 }}ms"
                                    class="animate-slide-in"
                                    onclick="window.location='{{ route('posts.show', $post) }}'">
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            {{-- Status Indicator --}}
                                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                            <div>
                                                <div class="font-medium text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-[#f53003] transition-colors">
                                                    {{ $post->title }}
                                                </div>
                                                <div class="text-xs text-[#706f6c] dark:text-[#A1A09A] sm:hidden mt-1">
                                                    {{ $post->created_at->format('d M Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="relative">
                                                <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 transition-transform duration-300 group-hover:scale-110 group-hover:border-[#f53003]" 
                                                     src="{{ $post->user->profile_photo_url }}" 
                                                     alt="{{ $post->user->name }}">
                                                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 rounded-full ring-2 ring-white dark:ring-[#1D0002]"></span>
                                            </div>
                                            <span class="hover:text-[#f53003] transition-colors">{{ $post->user->name }}</span>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 hidden sm:table-cell">
                                        <div class="flex items-center gap-1 text-[#706f6c] dark:text-[#A1A09A]">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $post->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2" onclick="event.stopPropagation()">
                                            {{-- View Button --}}
                                            <a href="{{ route('posts.show', $post) }}"
                                               class="p-2 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-all duration-300 hover:scale-125 relative group/btn"
                                               title="View">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-[#1b1b18] text-white text-xs rounded opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                                    View Post
                                                </span>
                                            </a>

                                            @if(auth()->id() === $post->user_id)
                                                {{-- Edit Button --}}
                                                <a href="{{ route('posts.edit', $post) }}"
                                                   class="p-2 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-all duration-300 hover:scale-125 hover:rotate-12 relative group/btn"
                                                   title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-[#1b1b18] text-white text-xs rounded opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                                        Edit Post
                                                    </span>
                                                </a>

                                                {{-- Delete Button with Confirmation --}}
                                                <form action="{{ route('posts.destroy', $post) }}"
                                                      method="POST"
                                                      class="inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="p-2 text-[#706f6c] dark:text-[#A1A09A] hover:text-red-500 dark:hover:text-red-400 transition-all duration-300 hover:scale-125 hover:rotate-12 relative group/btn"
                                                            title="Delete">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-red-500 text-white text-xs rounded opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                                            Delete Post
                                                        </span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    {{-- Empty State with Animation --}}
                    <div class="text-center py-16">
                        <div class="relative inline-block">
                            <div class="w-24 h-24 bg-[#fff2f2] dark:bg-[#1D0002] rounded-full flex items-center justify-center animate-bounce-slow mx-auto mb-6">
                                <svg class="w-12 h-12 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            
                            {{-- Floating particles --}}
                            <div class="absolute -top-2 -right-2 w-4 h-4 bg-[#f53003] rounded-full animate-ping"></div>
                            <div class="absolute -bottom-2 -left-2 w-3 h-3 bg-[#ff8a5c] rounded-full animate-ping" style="animation-delay: 0.5s"></div>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-3">No blogs yet</h3>
                        <p class="text-[#706f6c] dark:text-[#A1A09A] mb-8 max-w-md mx-auto">
                            Get started by creating your first blog post and share your thoughts with the world!
                        </p>
                        
                        {{-- Create Button with Animation --}}
                        <a href="{{ route('posts.create') }}" 
                           class="group relative inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] text-white rounded-xl hover:shadow-2xl transition-all duration-500 hover:scale-110 overflow-hidden">
                            <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300"></span>
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span class="font-semibold">Write Your First Blog</span>
                            
                            {{-- Shine effect --}}
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-transparent via-white to-transparent -skew-x-12 animate-shine"></div>
                            </div>
                        </a>
                        
                        {{-- Inspiration Text --}}
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-6">
                            ✨ Share your story with the community
                        </p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Recent Activity Feed with Timeline --}}
        @if($myPosts->count() > 0)
            <div x-show="statsLoaded"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:enter-delay="700"
                 class="bg-white dark:bg-[#161615] rounded-xl shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] p-6">
                
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Recent Activity</h3>
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Your latest blog posts</p>
                    </div>
                </div>
                
                {{-- Timeline --}}
                <div class="space-y-4">
                    @foreach($myPosts->take(5) as $index => $post)
                        <div class="relative pl-8 group cursor-pointer hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] p-3 rounded-lg transition-all duration-300 hover:scale-[1.02]"
                             x-data="{ hover: false }"
                             @mouseenter="hover = true"
                             @mouseleave="hover = false"
                             @click="window.location='{{ route('posts.show', $post) }}'">
                            
                            {{-- Timeline Line --}}
                            @if(!$loop->last)
                                <div class="absolute left-3 top-8 bottom-0 w-0.5 bg-gradient-to-b from-[#f53003] to-transparent"></div>
                            @endif
                            
                            {{-- Timeline Dot with Animation --}}
                            <div class="absolute left-0 top-1/2 transform -translate-y-1/2">
                                <div class="relative">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-[#f53003] to-[#ff8a5c] flex items-center justify-center transform transition-all duration-300"
                                         :class="{ 'scale-125': hover }">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-0 rounded-full animate-ping bg-[#f53003] opacity-20"
                                         x-show="hover"
                                         x-transition:enter="transition-opacity duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-20"></div>
                                </div>
                            </div>
                            
                            {{-- Content --}}
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <p class="text-[#1b1b18] dark:text-[#EDEDEC] font-medium">
                                        You created 
                                        <span class="text-[#f53003] hover:underline">"{{ $post->title }}"</span>
                                    </p>
                                    <div class="flex items-center gap-3 mt-1">
                                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $post->created_at->diffForHumans() }}
                                        </p>
                                        <span class="w-1 h-1 bg-[#706f6c] rounded-full"></span>
                                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">
                                            {{ Str::words($post->content, 5) }}...
                                        </p>
                                    </div>
                                </div>
                                
                                {{-- Arrow Indicator --}}
                                <svg class="w-5 h-5 text-[#706f6c] opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-0 group-hover:translate-x-1" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                {{-- View All Activity Link --}}
                <div class="mt-6 text-center">
                    <a href="{{ route('posts.my') }}" 
                       class="inline-flex items-center gap-2 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-all duration-300 hover:gap-3 group">
                        View all activity
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endif
    </div>

    {{-- Custom Styles --}}
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
            opacity: 0;
        }
        
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-bounce-slow {
            animation: bounce-slow 2s ease-in-out infinite;
        }
        
        @keyframes shine {
            from {
                left: -100%;
            }
            to {
                left: 200%;
            }
        }
        
        .animate-shine {
            animation: shine 1.5s ease-in-out;
        }
        
        .perspective {
            perspective: 1000px;
        }
        
        .preserve-3d {
            transform-style: preserve-3d;
        }
    </style>
</x-app-layout>