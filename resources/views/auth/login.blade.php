{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <div x-data="{ 
        showDemo: false, 
        showPassword: false,
        email: '',
        password: '',
        remember: false,
        loading: false,
        
        submitForm() {
            this.loading = true;
            this.$refs.loginForm.submit();
        }
    }" class="space-y-6">
        
        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 animate-bounce-in">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-6 text-center" data-aos="fade-down" data-aos-duration="800">
            <div class="flex items-center justify-center gap-2 mb-4 group">
                <svg class="w-10 h-10 text-[#f53003] transition-transform duration-500 group-hover:rotate-180" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                <span class="font-bold text-2xl bg-clip-text text-transparent bg-gradient-to-r from-[#f53003] to-[#ff8a5c]">{{ config('app.name', 'BlogSpace') }}</span>
            </div>
            <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Welcome back</h2>
            <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mt-2">Sign in to continue your writing journey</p>
        </div>

        <form method="POST" action="{{ route('login') }}" @submit.prevent="submitForm" x-ref="loginForm" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                <label for="email" class="block text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2">
                    {{ __('Email Address') }}
                </label>
                <div class="relative group">
                    <input id="email" 
                        type="email" 
                        name="email" 
                        x-model="email"
                        value="{{ old('email') }}"
                        required 
                        autofocus 
                        autocomplete="username" 
                        class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] focus:ring-1 focus:ring-[#f53003] transition-all duration-300 hover:shadow-lg hover:border-[#f53003] text-[#1b1b18] dark:text-[#EDEDEC]"
                        placeholder="john@example.com" />
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#f53003] opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-[#f53003]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium">
                        {{ __('Password') }}
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#f53003] hover:underline transition-all duration-300 hover:scale-105 hover:font-medium group">
                            Forgot password?
                            <span class="block max-w-0 group-hover:max-w-full transition-all duration-500 h-0.5 bg-[#f53003]"></span>
                        </a>
                    @endif
                </div>

                <div class="relative group">
                    <input id="password" 
                        :type="showPassword ? 'text' : 'password'"
                        name="password"
                        x-model="password"
                        required 
                        autocomplete="current-password" 
                        class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] focus:ring-1 focus:ring-[#f53003] transition-all duration-300 hover:shadow-lg hover:border-[#f53003] text-[#1b1b18] dark:text-[#EDEDEC]"
                        placeholder="••••••••" />
                    
                    <button type="button" 
                            @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#706f6c] hover:text-[#f53003] transition-all duration-300 hover:scale-110">
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-[#f53003]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                <label class="flex items-center cursor-pointer group">
                    <input id="remember_me" 
                        type="checkbox" 
                        x-model="remember"
                        name="remember"
                        class="h-4 w-4 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm text-[#f53003] focus:ring-[#f53003] transition-all duration-300 hover:scale-110 group-hover:border-[#f53003]" />
                    <span class="ml-2 text-sm text-[#706f6c] dark:text-[#A1A09A] group-hover:text-[#f53003] transition-colors duration-300">
                        {{ __('Keep me signed in') }}
                    </span>
                </label>
            </div>

            <div class="flex flex-col space-y-4" data-aos="fade-up" data-aos-delay="250" data-aos-duration="600">
                <button type="submit" 
                        class="w-full justify-center px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white transition-all duration-300 hover:scale-105 hover:shadow-xl font-medium relative overflow-hidden group disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="loading">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <svg x-show="!loading" class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <svg x-show="loading" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span x-text="loading ? 'Signing In...' : 'Sign In'"></span>
                    </span>
                    <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </button>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[#e3e3e0] dark:border-[#3E3E3A]"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-[#161615] text-[#706f6c] dark:text-[#A1A09A]">New to our community?</span>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-[#f53003] hover:underline font-medium group transition-all duration-300 hover:scale-105">
                        Create an account
                        <svg class="w-4 h-4 transition-all duration-300 group-hover:translate-x-2 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </form>

        {{-- Social Login Options (Optional) --}}
        <div class="grid grid-cols-2 gap-3" data-aos="fade-up" data-aos-delay="300">
            <button class="flex items-center justify-center gap-2 px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] transition-all duration-300 hover:scale-105 hover:shadow-lg group">
                <svg class="w-5 h-5 text-[#DB4437] group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7.635 10.909v2.619h4.335c-.173 1.125-1.31 3.295-4.331 3.295-2.604 0-4.731-2.16-4.731-4.823 0-2.664 2.127-4.824 4.731-4.824 1.485 0 2.478.633 3.045 1.178l2.073-1.994c-1.33-1.245-3.057-1.995-5.115-1.995C3.412 4.365 0 7.715 0 12c0 4.285 3.412 7.635 7.635 7.635 4.41 0 7.332-3.098 7.332-7.461 0-.501-.054-.885-.12-1.265H7.635z"/>
                </svg>
                <span class="text-sm">Google</span>
            </button>
            <button class="flex items-center justify-center gap-2 px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] transition-all duration-300 hover:scale-105 hover:shadow-lg group">
                <svg class="w-5 h-5 text-[#1877F2] group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                <span class="text-sm">Facebook</span>
            </button>
        </div>

        {{-- Quick tips with animations --}}
        <div class="mt-8 pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A]" data-aos="fade-up" data-aos-delay="350">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="text-center group cursor-pointer hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] p-3 rounded-lg transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="text-[#f53003] font-semibold text-lg group-hover:scale-110 transition-transform counter" data-target="10000">0</div>
                    <div class="text-[#706f6c] dark:text-[#A1A09A] text-xs">Active Writers</div>
                </div>
                <div class="text-center group cursor-pointer hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] p-3 rounded-lg transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="text-[#f53003] font-semibold text-lg group-hover:scale-110 transition-transform counter" data-target="50000">0</div>
                    <div class="text-[#706f6c] dark:text-[#A1A09A] text-xs">Blog Posts</div>
                </div>
            </div>
        </div>

        {{-- Demo credentials with animation (remove in production) --}}
        @if(app()->environment('local'))
            <div class="mt-4 p-4 bg-gradient-to-r from-[#fff2f2] to-[#ffe4e4] dark:from-[#1D0002] dark:to-[#2D0004] rounded-sm cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-xl"
                 @click="showDemo = !showDemo"
                 data-aos="fade-up"
                 data-aos-delay="400">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium text-[#f53003] flex items-center gap-2">
                        <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Demo Credentials
                    </p>
                    <svg class="w-4 h-4 text-[#f53003] transition-all duration-300" 
                         :class="{ 'rotate-180': showDemo }" 
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                <div x-show="showDemo" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-3 space-y-2">
                    <div class="flex items-center gap-2 text-xs">
                        <span class="px-2 py-1 bg-[#f53003] text-white rounded-sm">Email</span>
                        <code class="text-[#706f6c] dark:text-[#A1A09A]">demo@example.com</code>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="px-2 py-1 bg-[#f53003] text-white rounded-sm">Password</span>
                        <code class="text-[#706f6c] dark:text-[#A1A09A]">password</code>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Counter Animation Script --}}
    <script>
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const increment = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                };

                updateCount();
            });
        }

        // Run counters when element is in viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.counter').forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
</x-guest-layout>