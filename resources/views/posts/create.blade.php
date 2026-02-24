{{-- resources/views/posts/create.blade.php --}}
<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6 relative">
        {{-- Animated Background Elements --}}
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute top-20 left-20 w-72 h-72 bg-[#f53003] opacity-5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-20 w-72 h-72 bg-[#ff8a5c] opacity-5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        {{-- Header with Animation --}}
        <div class="mb-8 relative" data-aos="fade-down">
            <div class="absolute -left-4 top-1/2 transform -translate-y-1/2 w-1 h-12 bg-gradient-to-b from-[#f53003] to-[#ff8a5c] rounded-full"></div>
            <div class="pl-6">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-[#f53003] to-[#ff8a5c] bg-clip-text text-transparent">
                    Create New Post
                </h1>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-2 flex items-center gap-2">
                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Share your thoughts with the world
                </p>
            </div>
        </div>

        {{-- Success Message with Animation --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-l-4 border-green-500 rounded-lg animate-slide-down" data-aos="fade-up">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center animate-pulse">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Validation Errors with Animation --}}
        @if($errors->any())
            <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border-l-4 border-red-500 rounded-lg animate-shake" data-aos="fade-up">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-300 mb-2">Please fix the following errors:</h3>
                        <ul class="list-disc list-inside space-y-1 text-sm text-red-700 dark:text-red-400">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center gap-2">
                                    <span class="w-1 h-1 bg-red-500 rounded-full"></span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Form with Glass Effect --}}
        <form action="{{ route('posts.store') }}" method="POST" class="bg-white/90 dark:bg-[#161615]/90 backdrop-blur-sm shadow-2xl rounded-2xl p-8 space-y-6 relative overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
            {{-- Animated background gradient --}}
            <div class="absolute inset-0 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
            
            {{-- Decorative elements --}}
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-bl-full opacity-10"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 bg-gradient-to-br from-[#ff8a5c] to-[#f53003] rounded-tr-full opacity-10"></div>
            
            @csrf

            {{-- Title Input --}}
            <div class="relative group/input" data-aos="fade-up" data-aos-delay="150">
                <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2 group-hover/input:text-[#f53003] transition-colors">
                    Blog Title
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ old('title') }}"
                        class="w-full px-4 py-3 pl-11 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-xl focus:outline-none focus:border-[#f53003] dark:focus:border-[#FF4433] transition-all duration-300 hover:shadow-lg focus:shadow-lg focus:scale-[1.02] text-[#1b1b18] dark:text-[#EDEDEC]"
                        placeholder="Enter an engaging title"
                        required
                    >
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#706f6c] group-hover/input:text-[#f53003] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                    
                    {{-- Character counter --}}
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-xs text-[#706f6c]">
                        <span x-data="{ count: 0 }" x-text="count + '/100'" x-init="$watch('$el.previousElementSibling.value', value => count = value.length)"></span>
                    </div>
                </div>
                @error('title')
                    <p class="mt-2 text-sm text-[#f53003] flex items-center gap-1 animate-pulse">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Content Input --}}
            <div class="relative group/input" data-aos="fade-up" data-aos-delay="200">
                <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2 group-hover/input:text-[#f53003] transition-colors">
                    Content
                </label>
                <div class="relative">
                    <textarea 
                        name="content" 
                        rows="12"
                        class="w-full px-4 py-3 pl-11 border-2 border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-xl focus:outline-none focus:border-[#f53003] dark:focus:border-[#FF4433] transition-all duration-300 hover:shadow-lg focus:shadow-lg focus:scale-[1.02] text-[#1b1b18] dark:text-[#EDEDEC] resize-y"
                        placeholder="Write your blog content here..."
                        required
                    >{{ old('content') }}</textarea>
                    <div class="absolute left-3 top-4 text-[#706f6c] group-hover/input:text-[#f53003] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    
                    {{-- Word counter --}}
                    <div class="absolute right-3 bottom-3 text-xs text-[#706f6c] bg-white dark:bg-[#161615] px-2 py-1 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <span x-data="{ words: 0 }" x-text="words + ' words'" x-init="$watch('$el.closest('.relative').querySelector('textarea').value', value => words = value.trim().split(/\s+/).filter(w => w.length > 0).length)"></span>
                    </div>
                </div>
                @error('content')
                    <p class="mt-2 text-sm text-[#f53003] flex items-center gap-1 animate-pulse">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Publishing options with animation --}}
            <div class="flex items-center gap-4 pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A] relative" data-aos="fade-up" data-aos-delay="250">
                <div class="absolute -top-px left-0 w-20 h-0.5 bg-gradient-to-r from-[#f53003] to-[#ff8a5c]"></div>
                
                <button 
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] text-white rounded-xl hover:from-[#ff8a5c] hover:to-[#f53003] transition-all duration-300 hover:scale-105 hover:shadow-xl font-medium group/btn relative overflow-hidden"
                >
                    <span class="absolute inset-0 bg-white opacity-0 group-hover/btn:opacity-20 transition-opacity duration-300"></span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    <span>Publish Post</span>
                </button>
                
                <a href="{{ route('posts.index') }}" 
                   class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-all duration-300 hover:scale-110 flex items-center gap-1 group">
                    <span>Cancel</span>
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </div>
        </form>

        {{-- Writing tips with animation --}}
        <div class="mt-6 p-6 bg-gradient-to-br from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004] rounded-xl relative overflow-hidden group" data-aos="fade-up" data-aos-delay="300">
            <div class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
            
            <div class="relative z-10">
                <h4 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-3 flex items-center gap-2">
                    <div class="w-6 h-6 bg-gradient-to-br from-[#f53003] to-[#ff8a5c] rounded-lg flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span>Writing Tips</span>
                </h4>
                <ul class="text-xs text-[#706f6c] dark:text-[#A1A09A] space-y-2">
                    <li class="flex items-center gap-2 group/tip">
                        <span class="w-1 h-1 bg-[#f53003] rounded-full group-hover/tip:scale-150 transition-transform"></span>
                        Use a catchy title that grabs attention
                    </li>
                    <li class="flex items-center gap-2 group/tip">
                        <span class="w-1 h-1 bg-[#ff8a5c] rounded-full group-hover/tip:scale-150 transition-transform"></span>
                        Break up long content with paragraphs
                    </li>
                    <li class="flex items-center gap-2 group/tip">
                        <span class="w-1 h-1 bg-[#f53003] rounded-full group-hover/tip:scale-150 transition-transform"></span>
                        Add your unique perspective to make it engaging
                    </li>
                    <li class="flex items-center gap-2 group/tip">
                        <span class="w-1 h-1 bg-[#ff8a5c] rounded-full group-hover/tip:scale-150 transition-transform"></span>
                        Aim for at least 300 words for better engagement
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>