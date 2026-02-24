{{-- resources/views/terms.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Terms and conditions for using our blog platform.">

        <title>{{ config('app.name', 'BlogSpace') }} - Terms of Service</title>

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
            <div class="absolute top-20 left-20 w-72 h-72 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-20 w-72 h-72 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        {{-- Navigation with animation --}}
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

        {{-- Terms of Service Content with Staggered Animations --}}
        <section class="max-w-3xl mx-auto px-6 py-16 lg:py-20">
            <div data-aos="fade-down" data-aos-duration="800">
                <h1 class="text-4xl font-bold mb-4 text-center">
                    Terms of <span class="text-[#f53003] relative inline-block">
                        Service
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
                    $sections = [
                        [
                            'title' => '1. Acceptance of Terms',
                            'content' => 'By accessing or using our blog platform, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.',
                            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                        ],
                        [
                            'title' => '2. User Accounts',
                            'content' => 'To use certain features, you must create an account. You are responsible for:',
                            'list' => [
                                'Maintaining the security of your account',
                                'All activities that occur under your account',
                                'Providing accurate and complete information',
                                'Not sharing your login credentials'
                            ],
                            'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
                        ],
                        [
                            'title' => '3. User Content',
                            'content' => 'You retain ownership of the content you post on our platform. By posting content, you grant us a non-exclusive license to:',
                            'list' => [
                                'Host and display your content',
                                'Make your content available to other users',
                                'Use your content for platform promotion'
                            ],
                            'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'
                        ],
                        [
                            'title' => '4. Content Guidelines',
                            'content' => 'You agree not to post content that:',
                            'list' => [
                                'Violates any laws or regulations',
                                'Infringes on intellectual property rights',
                                'Contains hate speech or harassment',
                                'Is defamatory or obscene',
                                'Contains malicious code or spam'
                            ],
                            'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'
                        ],
                        [
                            'title' => '5. Intellectual Property',
                            'content' => 'The platform itself, including its code, design, and branding, is owned by us and protected by intellectual property laws. You may not copy, modify, or reverse engineer any part of the platform.',
                            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
                        ],
                        [
                            'title' => '6. Termination',
                            'content' => 'We reserve the right to suspend or terminate accounts that violate these terms or for any other reason at our discretion. You may delete your account at any time.',
                            'icon' => 'M20 12H4M6 10v4m4-8v12m4-8v8m4-4v4'
                        ],
                        [
                            'title' => '7. Disclaimer of Warranties',
                            'content' => 'The platform is provided "as is" without warranties of any kind. We do not guarantee that the platform will be error-free or uninterrupted.',
                            'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                        ],
                        [
                            'title' => '8. Limitation of Liability',
                            'content' => 'To the maximum extent permitted by law, we shall not be liable for any indirect, incidental, or consequential damages arising from your use of the platform.',
                            'icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636'
                        ],
                        [
                            'title' => '9. Changes to Terms',
                            'content' => 'We may modify these terms at any time. Continued use of the platform after changes constitutes acceptance of the new terms.',
                            'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'
                        ],
                        [
                            'title' => '10. Contact',
                            'content' => 'For questions about these terms, please ',
                            'link' => 'contact us',
                            'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
                        ],
                    ];
                @endphp

                @foreach($sections as $index => $section)
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

        {{-- Footer with animation --}}
        <footer class="max-w-4xl mx-auto px-6 py-8 border-t border-[#e3e3e0] dark:border-[#3E3E3A] mt-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    © {{ date('Y') }} {{ config('app.name', 'BlogSpace') }}. All rights reserved.
                </p>
                <div class="flex gap-6">
                    <a href="{{ url('/about') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">About</a>
                    <a href="{{ url('/privacy') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#f53003] transition-all duration-300 hover:scale-110">Privacy</a>
                    <a href="{{ url('/terms') }}" class="text-sm text-[#f53003] font-medium">Terms</a>
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