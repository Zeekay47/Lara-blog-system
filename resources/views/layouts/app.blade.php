{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BlogSpace') }} - Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <style>
            /* Custom Animations */
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            
            @keyframes pulse-glow {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }
            
            @keyframes slide-in {
                from {
                    transform: translateX(-100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes bounce-slow {
                0%, 100% {
                    transform: translateY(0);
                    animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
                }
                50% {
                    transform: translateY(-5px);
                    animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
                }
            }
            
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
            
            .animate-pulse-glow {
                animation: pulse-glow 2s ease-in-out infinite;
            }
            
            .animate-slide-in {
                animation: slide-in 0.5s ease-out;
            }
            
            .animate-bounce-slow {
                animation: bounce-slow 2s infinite;
            }
            
            .gradient-border {
                position: relative;
                border: double 1px transparent;
                background-image: linear-gradient(white, white), 
                                  linear-gradient(to right, #f53003, #ff8a5c);
                background-origin: border-box;
                background-clip: padding-box, border-box;
            }
            
            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .text-shimmer {
                background: linear-gradient(
                    90deg,
                    #f53003 0%,
                    #ff8a5c 25%,
                    #f53003 50%,
                    #ff8a5c 75%,
                    #f53003 100%
                );
                background-size: 200% auto;
                color: transparent;
                -webkit-background-clip: text;
                background-clip: text;
                animation: shimmer 3s linear infinite;
            }
            
            @keyframes shimmer {
                to {
                    background-position: 200% center;
                }
            }
            
            .hover-lift {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .hover-lift:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 40px -10px rgba(245, 48, 3, 0.3);
            }
            
            .ripple-effect {
                position: relative;
                overflow: hidden;
            }
            
            .ripple-effect::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 5px;
                height: 5px;
                background: rgba(255, 255, 255, 0.5);
                opacity: 0;
                border-radius: 100%;
                transform: scale(1, 1) translate(-50%);
                transform-origin: 50% 50%;
            }
            
            .ripple-effect:focus:not(:active)::after {
                animation: ripple 1s ease-out;
            }
            
            @keyframes ripple {
                0% {
                    transform: scale(0, 0);
                    opacity: 0.5;
                }
                100% {
                    transform: scale(20, 20);
                    opacity: 0;
                }
            }

            /* Notification animations */
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }

            .notification-enter {
                animation: slideInRight 0.3s ease-out forwards;
            }

            .notification-leave {
                animation: slideOutRight 0.3s ease-in forwards;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-[#FDFDFC] via-[#FFF5F5] to-[#FDFDFC] dark:from-[#0a0a0a] dark:via-[#1a0a0a] dark:to-[#0a0a0a] text-[#1b1b18] min-h-screen"
          x-data="{ 
            loaded: false,
            darkMode: localStorage.getItem('darkMode') === 'true',
            notifications: [],
            toggleDarkMode() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode);
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            },
            loadingProgress: 0,
            showScrollTop: false,
            addNotification(message, type = 'success') {
                const id = Date.now();
                this.notifications.push({ id, message, type });
                setTimeout(() => {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                }, 3000);
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
            
            // Loading progress
            setInterval(() => {
                if (loadingProgress < 90) loadingProgress += 10;
            }, 100);
            window.addEventListener('load', () => loadingProgress = 100);
            
            // Scroll to top button
            window.addEventListener('scroll', () => {
                showScrollTop = window.scrollY > 500;
            });
            
            // Listen for custom notification events
            window.addEventListener('notify', (event) => {
                addNotification(event.detail.message, event.detail.type);
            });
          "
          :class="{ 'opacity-0': !loaded, 'opacity-100 transition-opacity duration-500': loaded }">
        
        {{-- Animated Background Particles --}}
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-20 w-72 h-72 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-500 opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
            
            {{-- Floating particles --}}
            <div class="absolute top-40 left-[10%] w-2 h-2 bg-[#f53003] rounded-full opacity-20 animate-float"></div>
            <div class="absolute top-60 right-[15%] w-3 h-3 bg-[#ff8a5c] rounded-full opacity-20 animate-float" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-40 left-[20%] w-4 h-4 bg-purple-500 rounded-full opacity-20 animate-float" style="animation-delay: 1s;"></div>
        </div>

        <div class="min-h-screen flex flex-col relative">
            {{-- Loading Progress Bar --}}
            <div class="fixed top-0 left-0 w-full h-1 bg-gray-200 dark:bg-gray-800 z-50">
                <div class="h-full bg-gradient-to-r from-[#f53003] to-[#ff8a5c] transition-all duration-500 relative overflow-hidden"
                     :style="{ width: loadingProgress + '%' }">
                    <div class="absolute inset-0 bg-white opacity-30 animate-pulse"></div>
                </div>
            </div>

            {{-- Notifications Container --}}
            <div class="fixed top-4 right-4 z-50 space-y-2 w-80">
                <template x-for="notification in notifications" :key="notification.id">
                    <div x-show="true"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-2"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 translate-x-2"
                         class="bg-white dark:bg-[#161615] rounded-lg shadow-lg border-l-4 overflow-hidden"
                         :class="{
                             'border-green-500': notification.type === 'success',
                             'border-red-500': notification.type === 'error',
                             'border-yellow-500': notification.type === 'warning',
                             'border-blue-500': notification.type === 'info'
                         }">
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg x-show="notification.type === 'success'" class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <svg x-show="notification.type === 'error'" class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <svg x-show="notification.type === 'warning'" class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <svg x-show="notification.type === 'info'" class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm text-[#1b1b18] dark:text-[#EDEDEC]" x-text="notification.message"></p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button @click="notifications = notifications.filter(n => n.id !== notification.id)" 
                                            class="inline-flex text-gray-400 hover:text-gray-500 transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            {{-- Progress bar for auto-dismiss --}}
                            <div class="mt-2 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-[#f53003] to-[#ff8a5c] animate-shrink"
                                     :style="{ animation: 'shrink 3s linear forwards' }"></div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Scroll to Top Button --}}
            <button x-show="showScrollTop"
                    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="fixed bottom-8 right-4 z-40 p-3 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 group">
                <svg class="w-6 h-6 transition-transform duration-300 group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
            </button>

            {{-- Dark Mode Toggle - Transparent version --}}
            <button @click="toggleDarkMode" 
                    class="fixed bottom-8 right-20 z-40 p-3 bg-transparent backdrop-blur-none border border-[#f53003]/30 dark:border-[#FF4433]/30 hover:border-[#f53003] dark:hover:border-[#FF4433] rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 hover:rotate-12 group">
                <!-- Sun Icon (Light Mode) -->
                <svg x-show="darkMode" 
                    class="w-6 h-6 text-[#f53003] transition-transform duration-300 group-hover:rotate-45" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <!-- Moon Icon (Dark Mode) -->
                <svg x-show="!darkMode" 
                    class="w-6 h-6 text-[#FF4433] transition-transform duration-300 group-hover:-rotate-12" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
                
                {{-- Tooltip --}}
                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-[#1b1b18] dark:bg-white text-white dark:text-[#1b1b18] text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Toggle theme
                </span>
            </button>
            {{-- Top Navbar --}}
            @include('layouts.navigation')

            <div class="flex flex-1 relative">
                {{-- Left Sidebar with gradient border --}}
                @auth
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 w-1 bg-gradient-to-b from-[#f53003] to-[#ff8a5c] opacity-50"></div>
                        <x-dashboard-navbar />
                    </div>
                @endauth

                {{-- Main Content with Page Transitions --}}
                <main class="flex-1 p-6 lg:p-8 overflow-auto relative">
                    {{-- Decorative corner accents --}}
                    <div class="absolute top-0 left-0 w-20 h-20 border-t-2 border-l-2 border-[#f53003] opacity-30 rounded-tl-lg"></div>
                    <div class="absolute top-0 right-0 w-20 h-20 border-t-2 border-r-2 border-[#ff8a5c] opacity-30 rounded-tr-lg"></div>
                    <div class="absolute bottom-0 left-0 w-20 h-20 border-b-2 border-l-2 border-[#ff8a5c] opacity-30 rounded-bl-lg"></div>
                    <div class="absolute bottom-0 right-0 w-20 h-20 border-b-2 border-r-2 border-[#f53003] opacity-30 rounded-br-lg"></div>

                    {{-- Page Heading with Animation --}}
                    @isset($header)
                        <div class="mb-6 relative" data-aos="fade-down">
                            <div class="absolute -left-4 top-1/2 transform -translate-y-1/2 w-1 h-12 bg-gradient-to-b from-[#f53003] to-[#ff8a5c] rounded-full"></div>
                            <div class="pl-6">
                                {{ $header }}
                            </div>
                        </div>
                    @endisset

                    {{-- Page Content with Fade In --}}
                    <div class="relative" data-aos="fade-up" data-aos-delay="100">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] opacity-0 hover:opacity-5 transition-opacity duration-500 pointer-events-none rounded-lg"></div>
                        {{ $slot }}
                    </div>
                </main>
            </div>

            {{-- Footer with glass effect --}}
            <footer class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] bg-white/80 dark:bg-[#161615]/80 backdrop-blur-sm py-4 px-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-5"></div>
                <div class="absolute -top-10 -right-10 w-20 h-20 bg-[#f53003] rounded-full opacity-10 animate-pulse"></div>
                <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-[#ff8a5c] rounded-full opacity-10 animate-pulse" style="animation-delay: 1s;"></div>
                
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-[#706f6c] dark:text-[#A1A09A] relative z-10">
                    <p class="hover-scale flex items-center gap-2">
                        <span class="w-1 h-4 bg-gradient-to-b from-[#f53003] to-[#ff8a5c] rounded-full"></span>
                        &copy; {{ date('Y') }} {{ config('app.name', 'BlogSpace') }}. All rights reserved.
                    </p>
                    <div class="flex gap-6">
                        <a href="{{ route('about') }}" class="relative group">
                            <span class="relative z-10 hover:text-[#f53003] dark:hover:text-[#FF4433] transition-all duration-300 hover:scale-110 inline-block">About</span>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] group-hover:w-full transition-all duration-300"></span>
                        </a>
                        <a href="{{ route('privacy') }}" class="relative group">
                            <span class="relative z-10 hover:text-[#f53003] dark:hover:text-[#FF4433] transition-all duration-300 hover:scale-110 inline-block">Privacy</span>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] group-hover:w-full transition-all duration-300"></span>
                        </a>
                        <a href="{{ route('terms') }}" class="relative group">
                            <span class="relative z-10 hover:text-[#f53003] dark:hover:text-[#FF4433] transition-all duration-300 hover:scale-110 inline-block">Terms</span>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] group-hover:w-full transition-all duration-300"></span>
                        </a>
                        <a href="{{ route('contact') }}" class="relative group">
                            <span class="relative z-10 hover:text-[#f53003] dark:hover:text-[#FF4433] transition-all duration-300 hover:scale-110 inline-block">Contact</span>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] group-hover:w-full transition-all duration-300"></span>
                        </a>
                    </div>
                </div>
            </footer>
        </div>

        <style>
            @keyframes shrink {
                from {
                    width: 100%;
                }
                to {
                    width: 0%;
                }
            }
            
            .animate-shrink {
                animation: shrink 3s linear forwards;
            }
        </style>
    </body>
</html>