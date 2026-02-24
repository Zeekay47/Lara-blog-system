{{-- resources/views/contact.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Get in touch with us.">

        <title>{{ config('app.name', 'BlogSpace') }} - Contact Us</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased overflow-x-hidden"
          x-data="{ 
            formSubmitted: false,
            formData: {
                name: '',
                email: '',
                subject: '',
                message: ''
            },
            submitForm() {
                this.formSubmitted = true;
                // Add your form submission logic here
                setTimeout(() => {
                    this.formSubmitted = false;
                    this.formData = { name: '', email: '', subject: '', message: '' };
                }, 3000);
            }
          }">
        
        {{-- Animated Background --}}
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
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

        {{-- Contact Content --}}
        <section class="max-w-4xl mx-auto px-6 py-16 lg:py-20">
            <div data-aos="fade-down" data-aos-duration="800">
                <h1 class="text-4xl font-bold mb-4 text-center">
                    Get in <span class="text-[#f53003] relative inline-block">
                        Touch
                        <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 10" preserveAspectRatio="none">
                            <path d="M0,5 Q150,0 300,5" stroke="#f53003" stroke-width="2" fill="none" stroke-dasharray="300" stroke-dashoffset="300">
                                <animate attributeName="stroke-dashoffset" from="300" to="0" dur="2s" fill="freeze" />
                            </path>
                        </svg>
                    </span>
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 text-center max-w-2xl mx-auto mb-12">
                    Have questions, feedback, or just want to say hello? We'd love to hear from you.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Contact Form with Animations --}}
                <div data-aos="fade-right" data-aos-duration="800">
                    <form class="space-y-6" @submit.prevent="submitForm">
                        @csrf
                        
                        {{-- Name Field --}}
                        <div class="group" data-aos="fade-up" data-aos-delay="100">
                            <label for="name" class="block text-sm font-medium mb-2 group-hover:text-[#f53003] transition-colors">Your Name</label>
                            <div class="relative">
                                <input type="text" id="name" name="name" x-model="formData.name"
                                       class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-all duration-300 hover:shadow-lg"
                                       placeholder="John Doe"
                                       required>
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#f53003] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        
                        {{-- Email Field --}}
                        <div class="group" data-aos="fade-up" data-aos-delay="150">
                            <label for="email" class="block text-sm font-medium mb-2 group-hover:text-[#f53003] transition-colors">Email Address</label>
                            <div class="relative">
                                <input type="email" id="email" name="email" x-model="formData.email"
                                       class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-all duration-300 hover:shadow-lg"
                                       placeholder="john@example.com"
                                       required>
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#f53003] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        
                        {{-- Subject Field --}}
                        <div class="group" data-aos="fade-up" data-aos-delay="200">
                            <label for="subject" class="block text-sm font-medium mb-2 group-hover:text-[#f53003] transition-colors">Subject</label>
                            <div class="relative">
                                <input type="text" id="subject" name="subject" x-model="formData.subject"
                                       class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-all duration-300 hover:shadow-lg"
                                       placeholder="How can we help?"
                                       required>
                                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#f53003] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        
                        {{-- Message Field --}}
                        <div class="group" data-aos="fade-up" data-aos-delay="250">
                            <label for="message" class="block text-sm font-medium mb-2 group-hover:text-[#f53003] transition-colors">Message</label>
                            <div class="relative">
                                <textarea id="message" name="message" x-model="formData.message" rows="5" 
                                          class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-all duration-300 hover:shadow-lg"
                                          placeholder="Your message here..."
                                          required></textarea>
                                <span class="absolute right-3 bottom-3 text-[#f53003] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        
                        {{-- Submit Button with Animation --}}
                        <button type="submit" 
                                class="w-full px-6 py-4 bg-[#1b1b18] text-white rounded-sm hover:bg-black transition-all duration-300 hover:scale-105 hover:shadow-xl relative overflow-hidden group"
                                data-aos="fade-up"
                                data-aos-delay="300"
                                :disabled="formSubmitted">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <span x-show="!formSubmitted">Send Message</span>
                                <span x-show="formSubmitted" class="flex items-center gap-2">
                                    Sending...
                                    <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </span>
                            </span>
                            <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        </button>
                    </form>
                </div>

                {{-- Contact Information --}}
                <div class="space-y-8" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                    <div>
                        <h2 class="text-2xl font-semibold mb-6">Contact Information</h2>
                        <div class="space-y-4">
                            {{-- Email --}}
                            <div class="flex items-start gap-4 group cursor-pointer hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] p-3 rounded-lg transition-all duration-300 hover:scale-105"
                                 data-aos="fade-up"
                                 data-aos-delay="100">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-full flex items-center justify-center flex-shrink-0 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-12">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium mb-1 group-hover:text-[#f53003] transition-colors">Email</h3>
                                    <p class="text-gray-600 dark:text-gray-400">hello@blogspace.com</p>
                                    <p class="text-gray-600 dark:text-gray-400">support@blogspace.com</p>
                                </div>
                            </div>
                            
                            {{-- Phone --}}
                            <div class="flex items-start gap-4 group cursor-pointer hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] p-3 rounded-lg transition-all duration-300 hover:scale-105"
                                 data-aos="fade-up"
                                 data-aos-delay="150">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-full flex items-center justify-center flex-shrink-0 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-12">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium mb-1 group-hover:text-[#f53003] transition-colors">Phone</h3>
                                    <p class="text-gray-600 dark:text-gray-400">+1 (555) 123-4567</p>
                                    <p class="text-gray-600 dark:text-gray-400">Mon-Fri, 9am-5pm EST</p>
                                </div>
                            </div>
                            
                            {{-- Office --}}
                            <div class="flex items-start gap-4 group cursor-pointer hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] p-3 rounded-lg transition-all duration-300 hover:scale-105"
                                 data-aos="fade-up"
                                 data-aos-delay="200">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-full flex items-center justify-center flex-shrink-0 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-12">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium mb-1 group-hover:text-[#f53003] transition-colors">Office</h3>
                                    <p class="text-gray-600 dark:text-gray-400">123 Blog Street</p>
                                    <p class="text-gray-600 dark:text-gray-400">San Francisco, CA 94105</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Social Links with Hover Effects --}}
                    <div data-aos="fade-up" data-aos-delay="250">
                        <h3 class="font-medium mb-4">Follow Us</h3>
                        <div class="flex gap-4">
                            @php
                                $socials = [
                                    ['icon' => 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879v-6.99h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.99C18.343 21.128 22 16.991 22 12z', 'color' => '#1877F2'],
                                    ['icon' => 'M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84', 'color' => '#1DA1F2'],
                                    ['icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z', 'color' => '#E4405F'],
                                ];
                            @endphp

                            @foreach($socials as $index => $social)
                            <a href="#" class="group" data-aos="zoom-in" data-aos-delay="{{ 300 + ($index * 50) }}">
                                <div class="w-10 h-10 bg-[#fff2f2] dark:bg-[#1D0002] rounded-full flex items-center justify-center hover:bg-gradient-to-br from-[#f53003] to-[#ff8a5c] transition-all duration-300 hover:scale-125 hover:rotate-12">
                                    <svg class="w-5 h-5 text-[#f53003] group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="{{ $social['icon'] }}"/>
                                    </svg>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- FAQ Link --}}
                    <div class="bg-gradient-to-br from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004] rounded-lg p-6 relative overflow-hidden group cursor-pointer hover:shadow-xl transition-all duration-500 hover:-translate-y-2"
                         data-aos="fade-up"
                         data-aos-delay="300">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                        
                        <div class="relative z-10">
                            <h3 class="font-semibold mb-2 flex items-center gap-2">
                                Quick Question?
                                <svg class="w-4 h-4 text-[#f53003] animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                                Check out our FAQ section for answers to common questions.
                            </p>
                            <a href="{{ route('faq') }}" class="text-[#f53003] hover:underline text-sm font-medium inline-flex items-center gap-1 group/link">
                                Visit FAQ
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
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
                    <a href="{{ url('/about') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">About</a>
                    <a href="{{ url('/privacy') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">Privacy</a>
                    <a href="{{ url('/terms') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">Terms</a>
                    <a href="{{ url('/contact') }}" class="text-sm text-[#f53003] font-medium">Contact</a>
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