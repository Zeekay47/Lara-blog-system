{{-- resources/views/components/dashboard-navbar.blade.php --}}
{{-- Sidebar with Advanced Animations --}}
<aside x-data="{ 
    sidebarOpen: false, 
    desktopCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
    hoveredItem: null,
    activeItem: null,
    toggleDesktopCollapse() {
        this.desktopCollapsed = !this.desktopCollapsed;
        localStorage.setItem('sidebarCollapsed', this.desktopCollapsed);
    },
    getIconColor(route) {
        return this.activeItem === route ? 'text-[#f53003]' : 'text-[#706f6c] dark:text-[#A1A09A]';
    }
}" 
       class="relative h-full"
       @toggle-sidebar.window="sidebarOpen = !sidebarOpen"
       @toggle-desktop-sidebar.window="toggleDesktopCollapse()"
       @set-active-item.window="activeItem = $event.detail">
    
    {{-- Desktop Toggle Button with advanced animation --}}
    <button @click="toggleDesktopCollapse()" 
            class="hidden md:flex absolute -right-3 top-20 z-50 items-center justify-center w-7 h-7 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] text-white border-2 border-white dark:border-[#161615] rounded-full shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-125 hover:rotate-180 animate-pulse-slow group">
        <svg class="w-4 h-4 transition-transform duration-500" 
             :class="{ 'rotate-180': desktopCollapsed }"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <!-- <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-[#1b1b18] text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            Toggle sidebar
        </span> -->
    </button>

    {{-- Mobile Hamburger Button with ripple effect --}}
    <button @click="sidebarOpen = !sidebarOpen" 
            @mousedown="rippleEffect($event)"
            class="fixed bottom-4 left-4 z-50 md:hidden flex items-center justify-center w-14 h-14 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] text-white rounded-full shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-110 active:scale-95 group">
        <svg x-show="!sidebarOpen" 
             class="w-6 h-6 transition-transform duration-500 group-hover:rotate-90" 
             :class="{ 'rotate-90': sidebarOpen }" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg x-show="sidebarOpen" 
             class="w-6 h-6 transition-transform duration-500 rotate-90" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full ring-2 ring-white animate-ping"></span>
    </button>

    {{-- Overlay for mobile with blur effect --}}
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-40 md:hidden">
    </div>

    {{-- Sidebar with advanced animations - FIXED SCROLLBAR ISSUE --}}
    <div class="fixed md:static inset-y-0 left-0 transform transition-all duration-500 ease-in-out z-50"
         :class="{
            'translate-x-0': sidebarOpen,
            '-translate-x-full': !sidebarOpen && !desktopCollapsed,
            'md:w-72': !desktopCollapsed,
            'md:w-24': desktopCollapsed,
            'md:translate-x-0': true
         }">
        
        {{-- Main container with flex column to handle content properly --}}
        <div class="h-full bg-gradient-to-b from-white to-[#FFF5F5] dark:from-[#161615] dark:to-[#1a0a0a] shadow-2xl transition-all duration-500 relative flex flex-col"
             :class="{ 'md:w-72': !desktopCollapsed, 'md:w-24': desktopCollapsed }">
            
            {{-- Decorative elements --}}
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#f53003] via-[#ff8a5c] to-[#f53003]"></div>
            <div class="absolute top-10 -right-10 w-20 h-20 bg-[#f53003] rounded-full opacity-5 blur-2xl pointer-events-none"></div>
            <div class="absolute bottom-10 -left-10 w-20 h-20 bg-[#ff8a5c] rounded-full opacity-5 blur-2xl pointer-events-none"></div>
            
            {{-- Mobile Header with enhanced styling --}}
            <div class="md:hidden p-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A] flex items-center justify-between bg-gradient-to-r from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004] flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <svg class="w-8 h-8 text-[#f53003] animate-spin-slow" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-green-500 rounded-full animate-ping"></span>
                    </div>
                    <div>
                        <span class="font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Menu</span>
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Navigation</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" 
                        class="p-2 rounded-lg hover:bg-white dark:hover:bg-[#161615] transition-all duration-300 hover:rotate-90 hover:scale-110 group">
                    <svg class="w-5 h-5 text-[#706f6c] dark:text-[#A1A09A] group-hover:text-[#f53003] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>


            {{-- Scrollable navigation area with hidden scrollbar but keeping functionality --}}
            <div class="flex-1 overflow-y-auto scrollbar-hide p-4">
                <nav class="space-y-1">
                    @php
                        $navItems = [
                            ['route' => 'dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard'],
                            ['route' => 'posts.index', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'label' => 'All Blogs'],
                            ['route' => 'posts.my', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'label' => 'My Blogs'],
                            ['route' => 'posts.create', 'icon' => 'M12 4v16m8-8H4', 'label' => 'Create Blog'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       @mouseenter="hoveredItem = '{{ $item['route'] }}'"
                       @mouseleave="hoveredItem = null"
                       @click="$dispatch('set-active-item', '{{ $item['route'] }}')"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group relative overflow-hidden"
                       :class="{
                            'justify-center': desktopCollapsed,
                            'bg-gradient-to-r from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004] text-[#f53003] font-medium shadow-lg': {{ request()->routeIs($item['route']) ? 'true' : 'false' }},
                            'text-[#706f6c] dark:text-[#A1A09A] hover:bg-gradient-to-r hover:from-[#fff2f2] hover:to-[#ffe4e4] dark:hover:from-[#1D0002] dark:hover:to-[#2D0004] hover:text-[#f53003] dark:hover:text-[#FF4433] hover:shadow-md': {{ request()->routeIs($item['route']) ? 'false' : 'true' }}
                       }">
                        {{-- Animated background gradient --}}
                        <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>
                        
                        {{-- Active indicator --}}
                        <span x-show="{{ request()->routeIs($item['route']) ? 'true' : 'false' }}"
                              class="absolute left-0 top-1/2 transform -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-[#f53003] to-[#ff8a5c] rounded-r-full">
                        </span>
                        
                        <div class="relative">
                            <svg class="w-5 h-5 flex-shrink-0 transition-all duration-500 group-hover:scale-125 group-hover:rotate-12" 
                                 :class="{ 'text-[#f53003]': {{ request()->routeIs($item['route']) ? 'true' : 'false' }} }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                            </svg>
                            
                            {{-- Notification badge (example) --}}
                            @if($item['route'] == 'posts.my' && Auth::user()->posts()->count() > 0)
                                <span class="absolute -top-1 -right-1 w-4 h-4 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] text-white text-xs rounded-full flex items-center justify-center animate-pulse">
                                    {{ Auth::user()->posts()->count() }}
                                </span>
                            @endif
                            
                            {{-- Ripple effect dot --}}
                            <span x-show="hoveredItem === '{{ $item['route'] }}' && !desktopCollapsed"
                                  x-transition:enter="transition-opacity duration-300"
                                  x-transition:enter-start="opacity-0"
                                  x-transition:enter-end="opacity-100"
                                  class="absolute -right-1 -top-1 w-2 h-2 bg-[#f53003] rounded-full animate-ping">
                            </span>
                        </div>
                        
                        <span x-show="!desktopCollapsed" 
                              class="transition-all duration-300 font-medium"
                              :class="{ 'translate-x-2': hoveredItem === '{{ $item['route'] }}' }">
                            {{ $item['label'] }}
                        </span>
                        
                        {{-- Tooltip for collapsed mode --}}
                        <span x-show="desktopCollapsed"
                              x-transition:enter="transition-all duration-300"
                              x-transition:enter-start="opacity-0 -translate-x-2"
                              x-transition:enter-end="opacity-100 translate-x-0"
                              class="absolute left-full ml-2 px-2 py-1 bg-[#1b1b18] text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap z-50">
                            {{ $item['label'] }}
                        </span>
                    </a>
                    @endforeach

                    {{-- Categories Link with enhanced styling --}}
                    <div class="pt-4 mt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A] relative">
                        <div class="absolute -top-px left-1/2 transform -translate-x-1/2 w-12 h-0.5 bg-gradient-to-r from-[#f53003] to-[#ff8a5c]"></div>
                        
                        <a href="#"
                           @mouseenter="hoveredItem = 'categories'"
                           @mouseleave="hoveredItem = null"
                           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group relative overflow-hidden"
                           :class="{ 'justify-center': desktopCollapsed }">
                            <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-300"></span>
                            
                            <svg class="w-5 h-5 flex-shrink-0 text-[#706f6c] dark:text-[#A1A09A] group-hover:text-[#f53003] transition-all duration-500 group-hover:scale-125 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                            </svg>
                            
                            <span x-show="!desktopCollapsed" 
                                  class="text-[#706f6c] dark:text-[#A1A09A] group-hover:text-[#f53003] transition-all duration-300 font-medium"
                                  :class="{ 'translate-x-2': hoveredItem === 'categories' }">
                                Categories
                            </span>
                            
                            {{-- Tooltip for collapsed mode --}}
                            <span x-show="desktopCollapsed"
                                  x-transition:enter="transition-all duration-300"
                                  x-transition:enter-start="opacity-0 -translate-x-2"
                                  x-transition:enter-end="opacity-100 translate-x-0"
                                  class="absolute left-full ml-2 px-2 py-1 bg-[#1b1b18] text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap z-50">
                                Categories
                            </span>
                        </a>
                    </div>
                </nav>
            </div>

            {{-- User info at bottom with enhanced styling --}}
            <div class="p-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A] bg-gradient-to-t from-white to-[#FFF5F5] dark:from-[#161615] dark:to-[#1a0a0a] transition-all duration-500 flex-shrink-0"
                 :class="{ 'text-center': desktopCollapsed }">
                
                <div class="flex items-center gap-3" :class="{ 'justify-center': desktopCollapsed }">
                    <div class="relative group">
                        <div class="relative">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-transparent group-hover:border-[#f53003] transition-all duration-500 group-hover:scale-110 group-hover:rotate-6" 
                                 src="{{ Auth::user()->profile_photo_url }}" 
                                 alt="{{ Auth::user()->name }}">
                            <span class="absolute bottom-0 right-0 block w-3 h-3 bg-green-500 rounded-full ring-2 ring-white dark:ring-[#161615] animate-pulse"></span>
                        </div>
                        
                        {{-- Online status text tooltip --}}
                        <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-[#1b1b18] text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                            Online
                        </span>
                    </div>
                    
                    <div x-show="!desktopCollapsed" 
                         x-transition:enter="transition-all duration-500 delay-200"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] truncate group-hover:text-[#f53003] transition-colors">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] truncate flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
                
                {{-- Quick actions (visible when expanded) - IMPROVED ICON SIZING --}}
                <div x-show="!desktopCollapsed" 
                     class="mt-3 pt-3 border-t border-[#e3e3e0] dark:border-[#3E3E3A] grid grid-cols-3 gap-2">
                    <button class="p-2 text-xs text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] rounded-lg transition-all duration-300 hover:scale-105 flex flex-col items-center">
                        <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Settings</span>
                    </button>
                    <button class="p-2 text-xs text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] rounded-lg transition-all duration-300 hover:scale-105 flex flex-col items-center">
                        <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span>Help</span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="w-full p-2 text-xs text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] rounded-lg transition-all duration-300 hover:scale-105 flex flex-col items-center">
                            <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>

                {{-- Collapsed mode icons - IMPROVED VISIBILITY --}}
                <div x-show="desktopCollapsed" 
                     class="mt-2 flex flex-col items-center space-y-2">
                    <button class="p-2 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] rounded-lg transition-all duration-300 hover:scale-110 relative group/tooltip">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="absolute left-full ml-2 px-2 py-1 bg-[#1b1b18] text-white text-xs rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 whitespace-nowrap z-50">
                            Settings
                        </span>
                    </button>
                    <button class="p-2 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] rounded-lg transition-all duration-300 hover:scale-110 relative group/tooltip">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span class="absolute left-full ml-2 px-2 py-1 bg-[#1b1b18] text-white text-xs rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 whitespace-nowrap z-50">
                            Help
                        </span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="p-2 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] rounded-lg transition-all duration-300 hover:scale-110 relative group/tooltip">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="absolute left-full ml-2 px-2 py-1 bg-[#1b1b18] text-white text-xs rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 whitespace-nowrap z-50">
                                Logout
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</aside>

<style>
    /* Hide scrollbar but keep functionality */
    .scrollbar-hide {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;  /* Chrome, Safari and Opera */
    }
</style>

<script>
    function rippleEffect(event) {
        const button = event.currentTarget;
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.className = 'absolute bg-white bg-opacity-30 rounded-full pointer-events-none animate-ripple';
        
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    // Add smooth scrolling to all links
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>