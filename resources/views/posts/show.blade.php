{{-- resources/views/posts/show.blade.php --}}
<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 relative">
        {{-- Animated Background --}}
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute top-40 left-20 w-72 h-72 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-40 right-20 w-72 h-72 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        {{-- Back button --}}
        <div class="mb-6" data-aos="fade-right">
            <a href="{{ route('posts.index') }}" 
               class="inline-flex items-center gap-2 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to all posts
            </a>
        </div>

        {{-- Blog Post --}}
        <article class="bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg overflow-hidden" data-aos="fade-up">
            {{-- Header --}}
            <div class="p-8 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                <h1 class="text-4xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">{{ $post->title }}</h1>
                
                <div class="flex items-center gap-4 text-sm flex-wrap">
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700" 
                                 src="{{ $post->user->profile_photo_url }}" 
                                 alt="{{ $post->user->name }}">
                        </div>
                        <span class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">{{ $post->user->name }}</span>
                    </div>
                    
                    <span class="text-[#706f6c] dark:text-[#A1A09A]">•</span>
                    
                    <div class="flex items-center gap-2 text-[#706f6c] dark:text-[#A1A09A]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $post->created_at->format('F j, Y') }}</span>
                    </div>
                    
                    @if($post->created_at->format('Y-m-d') != $post->updated_at->format('Y-m-d'))
                        <span class="text-xs px-2 py-1 bg-[#fff2f2] dark:bg-[#1D0002] text-[#f53003] rounded-full">
                            Updated {{ $post->updated_at->diffForHumans() }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Content --}}
            <div class="p-8">
                <div class="prose prose-lg max-w-none dark:prose-invert">
                    @php
                        $paragraphs = explode("\n", $post->content);
                    @endphp
                    
                    @foreach($paragraphs as $paragraph)
                        @if(trim($paragraph))
                            <p class="mb-4 text-[#1b1b18] dark:text-[#EDEDEC] leading-relaxed">
                                {{ $paragraph }}
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Post metadata --}}
            <div class="px-8 pb-6 flex flex-wrap items-center gap-4 text-xs text-[#706f6c] dark:text-[#A1A09A] border-t border-[#e3e3e0] dark:border-[#3E3E3A] pt-4">
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Last updated {{ $post->updated_at->diffForHumans() }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                    </svg>
                    <span>{{ str_word_count($post->content) }} words</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>{{ ceil(str_word_count($post->content) / 200) }} min read</span>
                </div>
            </div>

            {{-- Footer with actions --}}
            @if(Auth::check() && Auth::id() === $post->user_id)
                <div class="p-6 bg-[#fff2f2] dark:bg-[#1D0002] border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            You are the author of this post
                        </p>
                        
                        <div class="flex gap-3">
                            <a href="{{ route('posts.edit', $post) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg hover:bg-black dark:hover:bg-white transition-colors text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Post
                            </a>
                            
                            <form action="{{ route('posts.destroy', $post) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#706f6c] dark:text-[#A1A09A] hover:border-[#f53003] dark:hover:border-[#FF4433] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete Post
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </article>

        {{-- Share section --}}
        <div class="mt-8 p-6 bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
                Share this post
            </h3>
            <div class="flex gap-3">
                <button onclick="copyToClipboard()" 
                        class="inline-flex items-center gap-2 px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-xs text-[#706f6c] dark:text-[#A1A09A] hover:border-[#f53003] dark:hover:border-[#FF4433] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors"
                        id="copyButton">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <span id="copyText">Copy Link</span>
                </button>
                
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-xs text-[#706f6c] dark:text-[#A1A09A] hover:border-[#1DA1F2] hover:text-[#1DA1F2] transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                    </svg>
                    Share on X
                </a>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                const button = document.getElementById('copyButton');
                const text = document.getElementById('copyText');
                const originalText = text.innerText;
                
                text.innerText = 'Copied!';
                button.classList.add('text-green-600', 'border-green-600');
                
                setTimeout(function() {
                    text.innerText = originalText;
                    button.classList.remove('text-green-600', 'border-green-600');
                }, 2000);
            });
        }
    </script>
</x-app-layout>