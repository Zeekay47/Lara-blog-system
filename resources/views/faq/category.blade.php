{{-- resources/views/faq/category.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Frequently asked questions about {{ $category }}.">

        <title>{{ config('app.name', 'BlogSpace') }} - {{ ucfirst($category) }} FAQ</title>

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
            
            @auth
                <a href="{{ url('/dashboard') }}" class="px-5 py-2 border border-[#19140035] hover:border-[#1915014a] rounded-sm text-sm">Dashboard</a>
            @else
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="px-5 py-2 text-sm hover:text-[#f53003] transition-colors">Log in</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 border border-[#19140035] hover:border-[#1915014a] rounded-sm text-sm">Register</a>
                </div>
            @endauth
        </header>

        {{-- Category Header --}}
        <section class="max-w-4xl mx-auto px-6 py-16 text-center" data-aos="fade-down">
            <div class="inline-block px-4 py-2 bg-[#fff2f2] dark:bg-[#1D0002] rounded-full text-[#f53003] text-sm mb-4">
                {{ ucfirst($category) }} FAQ
            </div>
            <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                {{ ucfirst($category) }} <span class="text-[#f53003]">Questions</span>
            </h1>
            <p class="text-lg text-[#706f6c] dark:text-[#A1A09A] max-w-2xl mx-auto">
                Find answers to common questions about {{ $category }}.
            </p>
            
            {{-- Back to all FAQs --}}
            <a href="{{ route('faq') }}" class="inline-flex items-center gap-2 text-[#f53003] hover:gap-3 transition-all mt-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to all FAQs
            </a>
        </section>

        {{-- Category Content --}}
        <div class="max-w-3xl mx-auto px-6 pb-20">
            @php
                $faqs = [
                    'account' => [
                        ['question' => 'How do I create an account?', 'answer' => 'Creating an account is free and easy! Click the "Register" button in the navigation bar, fill in your name, email, and password, and you\'re ready to start your blogging journey.'],
                        ['question' => 'Can I delete my account?', 'answer' => 'Yes, you can delete your account at any time. Go to your Profile settings and click on "Delete Account". Please note that this action is permanent and will remove all your posts and data.'],
                        ['question' => 'How do I reset my password?', 'answer' => 'Click on "Forgot Password" on the login page. Enter your email address, and we\'ll send you a link to reset your password. The link expires in 60 minutes for security.'],
                        ['question' => 'Can I change my username?', 'answer' => 'Currently, usernames cannot be changed after registration. Choose your username carefully when signing up!']
                    ],
                    'writing' => [
                        ['question' => 'How do I create a blog post?', 'answer' => 'Once logged in, click on "Create New Post" from your dashboard or the navigation menu. Add your title and content, then click "Publish Post" to share it with the community.'],
                        ['question' => 'Can I edit my posts after publishing?', 'answer' => 'Yes! You can edit your posts anytime. Go to "My Blogs" from the sidebar, find your post, and click the edit button. All changes will be visible immediately with an "Edited" tag.'],
                        ['question' => 'Is there a word limit for posts?', 'answer' => 'There\'s no strict word limit, but we recommend posts between 300-2000 words for optimal engagement. Very long posts can be split into multiple parts or series.'],
                        ['question' => 'Can I schedule posts?', 'answer' => 'Scheduling is coming soon! For now, all posts are published immediately. We\'re working on adding scheduling features in the next update.']
                    ],
                    'community' => [
                        ['question' => 'How can I interact with other writers?', 'answer' => 'You can comment on posts, follow other writers, and share posts on social media. We\'re also planning to add direct messaging and writer communities soon!'],
                        ['question' => 'Can I report inappropriate content?', 'answer' => 'Yes, each post has a report button. Click it to flag content that violates our community guidelines. Our moderation team reviews all reports within 24 hours.'],
                        ['question' => 'How do I follow other writers?', 'answer' => 'Click the "Follow" button on any author\'s profile or post. You\'ll receive notifications when they publish new content.'],
                        ['question' => 'Are comments moderated?', 'answer' => 'We have automated spam filtering and community reporting. All comments are reviewed if reported, and we actively moderate to maintain a positive community.']
                    ],
                    'technical' => [
                        ['question' => 'Is the platform mobile-friendly?', 'answer' => 'Absolutely! Our platform is fully responsive and works great on all devices - phones, tablets, and desktops. You can read and write posts on the go.'],
                        ['question' => 'How do I enable dark mode?', 'answer' => 'Click the moon/sun icon in the bottom left corner of the screen to toggle between light and dark mode. Your preference will be saved for future visits.'],
                        ['question' => 'Is my data secure?', 'answer' => 'Yes, we take security seriously. All data is encrypted, we use secure HTTPS connections, and we never share your personal information with third parties. Read our Privacy Policy for more details.'],
                        ['question' => 'What browsers are supported?', 'answer' => 'We support all modern browsers including Chrome, Firefox, Safari, and Edge. For the best experience, keep your browser updated to the latest version.']
                    ]
                ];
            @endphp

            <div class="space-y-4">
                @foreach($faqs[$category] as $index => $faq)
                    <div x-data="{ open: false }"
                         class="bg-white dark:bg-[#161615] rounded-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] overflow-hidden hover:shadow-lg transition-all"
                         data-aos="fade-up"
                         data-aos-delay="{{ $index * 50 }}">
                        
                        <button @click="open = !open" 
                                class="w-full px-6 py-4 text-left flex items-center justify-between group">
                            <span class="font-medium text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-[#f53003] transition-colors">
                                {{ $faq['question'] }}
                            </span>
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
                             class="px-6 pb-4">
                            <div class="border-l-2 border-[#f53003] pl-4">
                                <p class="text-[#706f6c] dark:text-[#A1A09A] leading-relaxed">
                                    {{ $faq['answer'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

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