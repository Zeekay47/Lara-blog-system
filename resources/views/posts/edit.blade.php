{{-- resources/views/posts/edit.blade.php --}}
<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6 relative">
        {{-- Animated Background --}}
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute top-20 left-20 w-72 h-72 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-20 w-72 h-72 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        {{-- Header --}}
        <div class="mb-8 relative" data-aos="fade-down">
            <div class="absolute -left-4 top-1/2 transform -translate-y-1/2 w-1 h-12 bg-gradient-to-b from-[#f53003] to-[#ff8a5c] rounded-full"></div>
            <div class="pl-6">
                <h1 class="text-4xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">
                    Edit <span class="text-[#f53003]">Blog Post</span>
                </h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-2 flex items-center gap-2">
                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Make changes to your post
                </p>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('posts.update', $post) }}" method="POST" class="bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-lg p-8 space-y-6" data-aos="fade-up" data-aos-delay="100">
            @csrf
            @method('PUT')

            {{-- Title Input --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                    Blog Title <span class="text-[#f53003]">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title', $post->title) }}" 
                    class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:border-[#f53003] dark:focus:border-[#FF4433] transition-colors text-[#1b1b18] dark:text-[#EDEDEC]"
                    required
                >
                @error('title')
                    <p class="text-sm text-[#f53003]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Content Input --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                    Content <span class="text-[#f53003]">*</span>
                </label>
                <textarea 
                    name="content" 
                    rows="10" 
                    class="w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-lg focus:outline-none focus:border-[#f53003] dark:focus:border-[#FF4433] transition-colors text-[#1b1b18] dark:text-[#EDEDEC]"
                    required
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-sm text-[#f53003]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Form actions --}}
            <div class="flex items-center gap-4 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                <button 
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-lg hover:bg-black dark:hover:bg-white transition-colors font-medium"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Post
                </button>
                
                <a href="{{ route('posts.show', $post) }}" 
                   class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors">
                    Cancel
                </a>
            </div>
        </form>

        {{-- Last edited info --}}
        <div class="mt-4 text-xs text-[#706f6c] dark:text-[#A1A09A] flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Last updated: {{ $post->updated_at->format('F j, Y \a\t g:i A') }}</span>
        </div>
    </div>
</x-app-layout>