{{-- resources/views/layouts/navigation.blade.php --}}
<nav x-data="{ open: false, searchFocused: false }" 
     class="bg-white/90 dark:bg-[#161615]/90 backdrop-blur-sm border-b border-[#e3e3e0] dark:border-[#3E3E3A] sticky top-0 z-40 transition-all duration-300"
     :class="{ 'shadow-lg': window.scrollY > 0 }"
     @scroll.window="open = window.scrollY > 0 ? false : open">
    
    <!-- Animated gradient line -->
    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-[#f53003] via-[#ff8a5c] to-[#f53003] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo with animation -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="relative group">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-lg flex items-center justify-center transform transition-all duration-500 group-hover:rotate-12 group-hover:scale-110">
                                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                </svg>
                            </div>
                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full ring-2 ring-white dark:ring-[#161615] animate-ping"></span>
                        </div>
                        <span class="font-bold text-xl bg-gradient-to-r from-[#f53003] to-[#ff8a5c] bg-clip-text text-transparent">
                            {{ config('app.name', 'BlogSpace') }}
                        </span>
                    </a>
                </div>
            </div>

            <!-- Search Bar with animation -->
            <div class="hidden sm:flex items-center flex-1 max-w-md mx-8">
                <div class="relative w-full group">
                    <form action="{{ route('posts.index') }}" method="GET">
                        <input type="text" 
                               name="search"
                               value="{{ request('search') }}"
                               @focus="searchFocused = true"
                               @blur="searchFocused = false"
                               placeholder="Search blogs..." 
                               class="w-full px-4 py-2 pl-10 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-lg text-sm text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:border-[#f53003] transition-all duration-300 hover:shadow-lg focus:shadow-lg focus:scale-105"
                               :class="{ 'ring-2 ring-[#f53003] ring-opacity-50': searchFocused }">
                        <div class="absolute left-3 top-2.5 text-[#706f6c] transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        
                        
                    </form>
                    
                    <!-- Animated search indicator -->
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] group-hover:w-full transition-all duration-300"></span>
                </div>
            </div>

            <!-- User Dropdown with animations -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] text-sm leading-4 font-medium rounded-lg text-[#1b1b18] dark:text-[#EDEDEC] bg-white dark:bg-[#161615] hover:border-[#f53003] dark:hover:border-[#FF4433] hover:shadow-lg focus:outline-none transition-all duration-300 group relative overflow-hidden">
                            <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>
                            
                            <div class="flex items-center gap-3 relative z-10">
                                <!-- User Avatar with pulse effect -->
                                <div class="relative">
                                    <img class="h-8 w-8 rounded-full object-cover border-2 border-transparent group-hover:border-[#f53003] transition-all duration-300 group-hover:scale-110" 
                                         src="{{ Auth::user()->profile_photo_url }}" 
                                         alt="{{ Auth::user()->name }}">
                                    <span class="absolute bottom-0 right-0 block w-2.5 h-2.5 bg-green-500 rounded-full ring-2 ring-white dark:ring-[#161615] animate-pulse"></span>
                                </div>
                                
                                <!-- User Name with gradient on hover -->
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200 hidden lg:inline group-hover:bg-gradient-to-r group-hover:from-[#f53003] group-hover:to-[#ff8a5c] group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300">
                                    {{ Auth::user()->name }}
                                </span>
                            </div>

                            <div class="ms-1 relative z-10">
                                <svg class="fill-current h-4 w-4 transition-transform duration-300 group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-1 bg-white dark:bg-[#161615] rounded-lg shadow-xl border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                            <div class="px-4 py-3 border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-gradient-to-r from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004]">
                                <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Signed in as</p>
                                <p class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] truncate flex items-center gap-2">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            
                            <x-dropdown-link :href="route('profile.edit')" 
                                           class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] hover:text-[#f53003] transition-all duration-300 group">
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] text-[#f53003] transition-all duration-300 group">
                                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger with animation -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="$dispatch('toggle-sidebar'); open = !open" 
                        class="inline-flex items-center justify-center p-2 rounded-lg text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] focus:outline-none transition-all duration-300 relative overflow-hidden group">
                    <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>
                    <svg class="h-6 w-6 transition-transform duration-300 group-hover:scale-110" :class="{ 'rotate-90': open }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Search with slide animation -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="sm:hidden px-4 py-2 border-t border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615]">
        <div class="relative group">
            <form action="{{ route('posts.index') }}" method="GET">
                <input type="text" 
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search blogs..." 
                       class="w-full px-4 py-2 pl-10 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-lg text-sm text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:border-[#f53003] transition-all duration-300 hover:shadow-lg">
                <div class="absolute left-3 top-2.5 text-[#706f6c] transition-transform duration-300 group-hover:scale-110">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </form>
        </div>
    </div>
</nav>