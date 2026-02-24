{{-- resources/views/faq/index.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Frequently asked questions about our blog platform.">

        <title>{{ config('app.name', 'BlogSpace') }} - FAQ</title>

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
            searchQuery: '',
            activeCategory: 'all',
            openFaq: null
          }">
        
        {{-- Animated Background --}}
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute top-20 left-20 w-72 h-72 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-20 w-72 h-72 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        {{-- Navigation --}}
        <header class="w-full max-w-7xl mx-auto px-6 py-6 flex items-center justify-between animate-slide-down">
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <svg class="w-8 h-8 text-[#f53003] transition-transform duration-500 group-hover:rotate-180" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    <span class="font-bold text-xl text-[#1b1b18] dark:text-[#EDEDEC]">{{ config('app.name', 'BlogSpace') }}</span>
                </a>
            </div>
            
            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-5 py-2 border border-[#19140035] hover:border-[#1915014a] rounded-sm text-sm transition-all duration-300 hover:scale-105">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2 text-sm hover:text-[#f53003] transition-all duration-300 hover:scale-105">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-5 py-2 border border-[#19140035] hover:border-[#1915014a] rounded-sm text-sm transition-all duration-300 hover:scale-105">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        {{-- FAQ Header --}}
        <section class="max-w-4xl mx-auto px-6 py-16 lg:py-20 text-center" data-aos="fade-down">
            <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                Frequently Asked <span class="text-[#f53003]">Questions</span>
            </h1>
            <p class="text-lg text-[#706f6c] dark:text-[#A1A09A] max-w-2xl mx-auto">
                Everything you need to know about our blog platform. Can't find what you're looking for? 
                <a href="{{ route('contact') }}" class="text-[#f53003] hover:underline">Contact us</a>.
            </p>
        </section>

        {{-- Search Bar --}}
        <div class="max-w-2xl mx-auto px-6 mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="relative group">
                <input type="text" 
                       x-model="searchQuery"
                       placeholder="Search FAQs..." 
                       class="w-full px-6 py-4 pl-14 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-xl focus:outline-none focus:border-[#f53003] transition-all duration-300 text-[#1b1b18] dark:text-[#EDEDEC]">
                <svg class="absolute left-5 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#706f6c] group-focus-within:text-[#f53003] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        {{-- Category Tabs --}}
        <div class="max-w-4xl mx-auto px-6 mb-8" data-aos="fade-up" data-aos-delay="150">
            <div class="flex flex-wrap justify-center gap-3">
                <button @click="activeCategory = 'all'" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeCategory === 'all' ? 'bg-[#f53003] text-white' : 'bg-[#fff2f2] dark:bg-[#1D0002] text-[#706f6c] dark:text-[#A1A09A] hover:bg-[#f53003] hover:text-white'">
                    All Questions
                </button>
                <button @click="activeCategory = 'account'" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeCategory === 'account' ? 'bg-[#f53003] text-white' : 'bg-[#fff2f2] dark:bg-[#1D0002] text-[#706f6c] dark:text-[#A1A09A] hover:bg-[#f53003] hover:text-white'">
                    Account
                </button>
                <button @click="activeCategory = 'writing'" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeCategory === 'writing' ? 'bg-[#f53003] text-white' : 'bg-[#fff2f2] dark:bg-[#1D0002] text-[#706f6c] dark:text-[#A1A09A] hover:bg-[#f53003] hover:text-white'">
                    Writing & Publishing
                </button>
                <button @click="activeCategory = 'community'" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeCategory === 'community' ? 'bg-[#f53003] text-white' : 'bg-[#fff2f2] dark:bg-[#1D0002] text-[#706f6c] dark:text-[#A1A09A] hover:bg-[#f53003] hover:text-white'">
                    Community
                </button>
                <button @click="activeCategory = 'technical'" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeCategory === 'technical' ? 'bg-[#f53003] text-white' : 'bg-[#fff2f2] dark:bg-[#1D0002] text-[#706f6c] dark:text-[#A1A09A] hover:bg-[#f53003] hover:text-white'">
                    Technical
                </button>
            </div>
        </div>

        {{-- FAQ Content --}}
        <div class="max-w-3xl mx-auto px-6 pb-20">
            @php
                $faqs = [
                    [
                        'category' => 'account',
                        'question' => 'How do I create an account?',
                        'answer' => 'Creating an account is free and easy! Click the "Register" button in the navigation bar, fill in your name, email, and password, and you\'re ready to start your blogging journey.',
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
                    ],
                    [
                        'category' => 'account',
                        'question' => 'Can I delete my account?',
                        'answer' => 'Yes, you can delete your account at any time. Go to your Profile settings and click on "Delete Account". Please note that this action is permanent and will remove all your posts and data.',
                        'icon' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'
                    ],
                    [
                        'category' => 'account',
                        'question' => 'How do I reset my password?',
                        'answer' => 'Click on "Forgot Password" on the login page. Enter your email address, and we\'ll send you a link to reset your password. The link expires in 60 minutes for security.',
                        'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'
                    ],
                    [
                        'category' => 'writing',
                        'question' => 'How do I create a blog post?',
                        'answer' => 'Once logged in, click on "Create New Post" from your dashboard or the navigation menu. Add your title and content, then click "Publish Post" to share it with the community.',
                        'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'
                    ],
                    [
                        'category' => 'writing',
                        'question' => 'Can I edit my posts after publishing?',
                        'answer' => 'Yes! You can edit your posts anytime. Go to "My Blogs" from the sidebar, find your post, and click the edit button. All changes will be visible immediately with an "Edited" tag.',
                        'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'
                    ],
                    [
                        'category' => 'writing',
                        'question' => 'Is there a word limit for posts?',
                        'answer' => 'There\'s no strict word limit, but we recommend posts between 300-2000 words for optimal engagement. Very long posts can be split into multiple parts or series.',
                        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
                    ],
                    [
                        'category' => 'community',
                        'question' => 'How can I interact with other writers?',
                        'answer' => 'You can comment on posts, follow other writers, and share posts on social media. We\'re also planning to add direct messaging and writer communities soon!',
                        'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
                    ],
                    [
                        'category' => 'community',
                        'question' => 'Can I report inappropriate content?',
                        'answer' => 'Yes, each post has a report button. Click it to flag content that violates our community guidelines. Our moderation team reviews all reports within 24 hours.',
                        'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'
                    ],
                    [
                        'category' => 'technical',
                        'question' => 'Is the platform mobile-friendly?',
                        'answer' => 'Absolutely! Our platform is fully responsive and works great on all devices - phones, tablets, and desktops. You can read and write posts on the go.',
                        'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'
                    ],
                    [
                        'category' => 'technical',
                        'question' => 'How do I enable dark mode?',
                        'answer' => 'Click the moon/sun icon in the bottom left corner of the screen to toggle between light and dark mode. Your preference will be saved for future visits.',
                        'icon' => 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z'
                    ],
                    [
                        'category' => 'technical',
                        'question' => 'Is my data secure?',
                        'answer' => 'Yes, we take security seriously. All data is encrypted, we use secure HTTPS connections, and we never share your personal information with third parties. Read our Privacy Policy for more details.',
                        'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
                    ]
                ];
            @endphp

            <div class="space-y-4">
                @foreach($faqs as $index => $faq)
                    <div x-data="{ open: false }"
                         x-show="(activeCategory === 'all' || activeCategory === '{{ $faq['category'] }}') && 
                                (searchQuery === '' || '{{ strtolower($faq['question']) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($faq['answer']) }}'.includes(searchQuery.toLowerCase()))"
                         x-transition:enter="transition-all duration-500"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="bg-white dark:bg-[#161615] rounded-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] overflow-hidden hover:shadow-lg transition-all"
                         data-aos="fade-up"
                         data-aos-delay="{{ $index * 50 }}">
                        
                        <button @click="open = !open" 
                                class="w-full px-6 py-4 text-left flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg flex items-center justify-center group-hover:bg-[#f53003] dark:group-hover:bg-[#f53003] transition-colors">
                                    <svg class="w-4 h-4 text-[#f53003] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $faq['icon'] }}"/>
                                    </svg>
                                </div>
                                <span class="font-medium text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-[#f53003] transition-colors">
                                    {{ $faq['question'] }}
                                </span>
                            </div>
                            <svg class="w-5 h-5 text-[#706f6c] transition-transform duration-300"
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition-all duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition-all duration-300"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="px-6 pb-4 pl-16">
                            <div class="border-l-2 border-[#f53003] pl-4">
                                <p class="text-[#706f6c] dark:text-[#A1A09A] leading-relaxed">
                                    {{ $faq['answer'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- No Results --}}
            <div x-show="!document.querySelector('[x-data]:not([style*=\"display: none\"])')"
                 x-transition:enter="transition-all duration-500"
                 class="text-center py-12">
                <div class="w-20 h-20 mx-auto mb-4 bg-[#fff2f2] dark:bg-[#1D0002] rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No matching questions</h3>
                <p class="text-[#706f6c] dark:text-[#A1A09A]">Try a different search or category</p>
            </div>
        </div>

        {{-- Still Have Questions --}}
        <section class="max-w-3xl mx-auto px-6 pb-20">
            <div class="bg-gradient-to-br from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004] rounded-2xl p-8 text-center relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                
                <h2 class="text-2xl font-bold mb-3">Still have questions?</h2>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mb-6 max-w-md mx-auto">
                    Can't find the answer you're looking for? Please chat with our friendly team.
                </p>
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg hover:bg-black dark:hover:bg-white transition-all duration-300 hover:scale-105 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Contact Support
                </a>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="max-w-7xl mx-auto px-6 py-8 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    © {{ date('Y') }} {{ config('app.name', 'BlogSpace') }}. All rights reserved.
                </p>
                <div class="flex gap-6">
                    <a href="{{ route('about') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors">About</a>
                    <a href="{{ route('privacy') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors">Privacy</a>
                    <a href="{{ route('terms') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors">Terms</a>
                    <a href="{{ route('contact') }}" class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-colors">Contact</a>
                    <a href="{{ route('faq') }}" class="text-sm text-[#f53003] font-medium">FAQ</a>
                </div>
            </div>
        </footer>

        <!-- AOS Script -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });
        </script>
    </body>
</html>