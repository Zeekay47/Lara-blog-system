{{-- resources/views/posts/index.blade.php --}}
<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
        {{-- Animated Background --}}
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute top-40 left-20 w-72 h-72 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-40 right-20 w-72 h-72 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">
                    All <span class="text-[#f53003]">Blogs</span>
                </h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Discover stories from our community</p>
            </div>

            <a href="{{ route('posts.create') }}"
               class="mt-4 sm:mt-0 inline-flex items-center gap-2 px-5 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg hover:bg-black dark:hover:bg-white transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Post
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg" data-aos="fade-up">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-green-800 dark:text-green-300">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Posts Grid --}}
        @if($posts->count())
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($posts as $index => $post)
                    <article class="bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg overflow-hidden hover:shadow-lg transition-all hover:-translate-y-1 group"
                             data-aos="fade-up"
                             data-aos-delay="{{ $index * 50 }}">
                        
                        <div class="p-6 flex flex-col h-full">
                            {{-- Author info --}}
                            <div class="flex items-center gap-3 mb-4">
                                <div class="relative">
                                    <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 group-hover:border-[#f53003] transition-colors" 
                                         src="{{ $post->user->profile_photo_url }}" 
                                         alt="{{ $post->user->name }}">
                                </div>    
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] truncate">
                                        {{ $post->user->name }}
                                    </p>
                                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            {{-- Post Content --}}
                            <h2 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2 line-clamp-2 group-hover:text-[#f53003] transition-colors">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-[#f53003]">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            
                            <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4 line-clamp-3 flex-1">
                                {{ Str::limit($post->content, 140) }}
                            </p>

                            {{-- Action Buttons --}}
                            <div class="flex items-center justify-between pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                                <a href="{{ route('posts.show', $post) }}"
                                   class="inline-flex items-center gap-1 text-sm text-[#f53003] hover:gap-2 transition-all">
                                    Read More
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                @if(Auth::id() === $post->user_id)
                                    <div class="flex gap-2">
                                        <a href="{{ route('posts.edit', $post) }}"
                                           class="p-1 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors"
                                           title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-1 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors"
                                                    title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if(method_exists($posts, 'links'))
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg p-12 text-center" data-aos="fade-up">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-[#fff2f2] dark:bg-[#1D0002] rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No posts available yet</h3>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">Be the first to share your thoughts with the community!</p>
                <a href="{{ route('posts.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg hover:bg-black dark:hover:bg-white transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Your First Post
                </a>
            </div>
        @endif
    </div>
</x-app-layout>