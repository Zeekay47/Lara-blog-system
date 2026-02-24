{{-- resources/views/posts/my.blade.php --}}
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
                    My <span class="text-[#f53003]">Blogs</span>
                </h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-1">Manage your published posts</p>
            </div>

            <a href="{{ route('posts.create') }}"
               class="mt-4 sm:mt-0 inline-flex items-center gap-2 px-5 py-2.5 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg hover:bg-black dark:hover:bg-white transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Write New Blog
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

        {{-- Stats Cards --}}
        @if($posts->count())
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8" data-aos="fade-up" data-aos-delay="50">
            <div class="bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Total Posts</p>
                        <p class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $posts->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Total Words</p>
                        <p class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $posts->sum(function($post) { return str_word_count($post->content); }) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#f53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Latest Post</p>
                        <p class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] truncate max-w-[150px]">
                            {{ $posts->first()->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
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
                            {{-- Post meta --}}
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs px-2 py-1 bg-[#fff2f2] dark:bg-[#1D0002] text-[#f53003] rounded-full">
                                    {{ $post->created_at->format('d M Y') }}
                                </span>
                                @if($post->created_at->format('Y-m-d') != $post->updated_at->format('Y-m-d'))
                                    <span class="text-xs text-[#706f6c] dark:text-[#A1A09A] flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                        Edited
                                    </span>
                                @endif
                            </div>

                            {{-- Post Content --}}
                            <h2 class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mb-2 line-clamp-2 group-hover:text-[#f53003] transition-colors">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-[#f53003]">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            
                            <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4 line-clamp-3 flex-1">
                                {{ Str::limit($post->content, 120) }}
                            </p>

                            {{-- Action Buttons --}}
                            <div class="flex flex-wrap gap-2 mt-auto pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                                <a href="{{ route('posts.show', $post) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-sm border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-[#706f6c] dark:text-[#A1A09A] hover:border-[#f53003] dark:hover:border-[#FF4433] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors">
                                    View
                                </a>

                                <a href="{{ route('posts.edit', $post) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-sm border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-[#706f6c] dark:text-[#A1A09A] hover:border-[#f53003] dark:hover:border-[#FF4433] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('posts.destroy', $post) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');"
                                      class="ml-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-flex items-center gap-1 px-3 py-1.5 text-sm border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-[#706f6c] dark:text-[#A1A09A] hover:border-[#f53003] dark:hover:border-[#FF4433] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">You haven't created any posts yet</h3>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">Start sharing your thoughts with the world!</p>
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