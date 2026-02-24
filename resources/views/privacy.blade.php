{{-- resources/views/privacy.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Our privacy policy and data protection practices.">

        <title>{{ config('app.name', 'BlogSpace') }} - Privacy Policy</title>

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
            <div class="absolute top-20 right-20 w-72 h-72 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 left-20 w-72 h-72 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
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

        {{-- Privacy Policy Content --}}
        <section class="max-w-3xl mx-auto px-6 py-16 lg:py-20">
            <div data-aos="fade-down" data-aos-duration="800">
                <h1 class="text-4xl font-bold mb-4 text-center">
                    Privacy <span class="text-[#f53003] relative inline-block">
                        Policy
                        <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 10" preserveAspectRatio="none">
                            <path d="M0,5 Q150,0 300,5" stroke="#f53003" stroke-width="2" fill="none" stroke-dasharray="300" stroke-dashoffset="300">
                                <animate attributeName="stroke-dashoffset" from="300" to="0" dur="2s" fill="freeze" />
                            </path>
                        </svg>
                    </span>
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-center mb-12">Last updated: {{ date('F j, Y') }}</p>
            </div>

            <div class="prose prose-lg max-w-none">
                @php
                    $privacySections = [
                        [
                            'title' => '1. Information We Collect',
                            'content' => 'We collect information you provide directly to us, such as when you create an account, create a blog post, or contact us for support. This information may include:',
                            'list' => [
                                'Name and email address',
                                'Profile information and avatar',
                                'Blog posts and comments you create',
                                'Communications with us'
                            ],
                            'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
                        ],
                        [
                            'title' => '2. How We Use Your Information',
                            'content' => 'We use the information we collect to:',
                            'list' => [
                                'Provide, maintain, and improve our services',
                                'Process your transactions and manage your account',
                                'Send you technical notices, updates, and support messages',
                                'Respond to your comments and questions',
                                'Protect against fraud and abuse'
                            ],
                            'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'
                        ],
                        [
                            'title' => '3. Sharing of Information',
                            'content' => 'We do not share your personal information with third parties except in the following circumstances:',
                            'list' => [
                                'With your consent',
                                'To comply with laws or legal requests',
                                'To protect the rights and safety of our users',
                                'In connection with a business transfer (merger, acquisition, etc.)'
                            ],
                            'icon' => 'M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z'
                        ],
                        [
                            'title' => '4. Data Security',
                            'content' => 'We take reasonable measures to help protect your personal information from loss, theft, misuse, and unauthorized access. However, no internet transmission is completely secure, and we cannot guarantee absolute security.',
                            'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'
                        ],
                        [
                            'title' => '5. Your Rights',
                            'content' => 'You have the right to:',
                            'list' => [
                                'Access and update your personal information',
                                'Delete your account and associated data',
                                'Opt-out of marketing communications',
                                'Request a copy of your data'
                            ],
                            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
                        ],
                        [
                            'title' => '6. Cookies',
                            'content' => 'We use cookies to enhance your experience on our site. You can control cookies through your browser settings. Learn more in our Cookie Policy.',
                            'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'
                        ],
                        [
                            'title' => '7. Changes to This Policy',
                            'content' => 'We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page with an updated effective date.',
                            'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'
                        ],
                        [
                            'title' => '8. Contact Us',
                            'content' => 'If you have questions about this privacy policy, please ',
                            'link' => 'contact us',
                            'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
                        ],
                    ];
                @endphp

                @foreach($privacySections as $index => $section)
                <div class="mb-8 group" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}"
                     data-aos-duration="600">
                    <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 border-l-4 border-[#f53003] hover:border-[#ff8a5c]">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-lg flex items-center justify-center transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $section['icon'] }}"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-2xl font-semibold mb-4 group-hover:text-[#f53003] transition-colors">{{ $section['title'] }}</h2>
                                
                                @if(isset($section['list']))
                                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $section['content'] }}</p>
                                    <ul class="list-disc pl-6 text-gray-600 dark:text-gray-400 space-y-2">
                                        @foreach($section['list'] as $item)
                                        <li class="transition-all duration-300 hover:translate-x-2 hover:text-[#f53003]">{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @elseif(isset($section['link']))
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ $section['content'] }}
                                        <a href="{{ url('/contact') }}" class="text-[#f53003] hover:underline font-medium transition-all duration-300 hover:scale-105 inline-block">
                                            {{ $section['link'] }}
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-600 dark:text-gray-400">{{ $section['content'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
                    <a href="{{ url('/privacy') }}" class="text-sm text-[#f53003] font-medium">Privacy</a>
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