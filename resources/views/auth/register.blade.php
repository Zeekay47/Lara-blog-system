{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <div x-data="{ 
        showPassword: false, 
        showConfirmPassword: false,
        passwordStrength: 0,
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
        loading: false,
        
        checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]+/)) strength += 25;
            if (password.match(/[A-Z]+/)) strength += 25;
            if (password.match(/[0-9]+/) || password.match(/[$@#&!]+/)) strength += 25;
            this.passwordStrength = strength;
        },
        
        submitForm() {
            this.loading = true;
            this.$refs.registerForm.submit();
        }
    }" class="space-y-6">
        
        <div class="mb-6 text-center" data-aos="fade-down" data-aos-duration="800">
            <div class="flex items-center justify-center gap-2 mb-4 group">
                <svg class="w-10 h-10 text-[#f53003] transition-transform duration-500 group-hover:rotate-180" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                <span class="font-bold text-2xl bg-clip-text text-transparent bg-gradient-to-r from-[#f53003] to-[#ff8a5c]">{{ config('app.name', 'BlogSpace') }}</span>
            </div>
            <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Create an account</h2>
            <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mt-2">Join our community of writers and readers</p>
        </div>

        <form method="POST" action="{{ route('register') }}" @submit.prevent="submitForm" x-ref="registerForm" class="space-y-6">
            @csrf

            <!-- Name -->
            <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                <label for="name" class="block text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2">
                    {{ __('Full Name') }}
                </label>
                <div class="relative group">
                    <input id="name" 
                        type="text" 
                        name="name" 
                        x-model="name"
                        value="{{ old('name') }}"
                        required 
                        autofocus 
                        autocomplete="name" 
                        class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] focus:ring-1 focus:ring-[#f53003] transition-all duration-300 hover:shadow-lg hover:border-[#f53003] text-[#1b1b18] dark:text-[#EDEDEC]"
                        placeholder="Imran Khan" />
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#f53003] opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-[#f53003]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
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
                        autocomplete="username" 
                        class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] focus:ring-1 focus:ring-[#f53003] transition-all duration-300 hover:shadow-lg hover:border-[#f53003] text-[#1b1b18] dark:text-[#EDEDEC]"
                        placeholder="imrankhan@example.com" />
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
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                <label for="password" class="block text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2">
                    {{ __('Password') }}
                </label>
                <div class="relative group">
                    <input id="password" 
                        :type="showPassword ? 'text' : 'password'"
                        name="password"
                        x-model="password"
                        required 
                        autocomplete="new-password" 
                        class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] focus:ring-1 focus:ring-[#f53003] transition-all duration-300 hover:shadow-lg hover:border-[#f53003] text-[#1b1b18] dark:text-[#EDEDEC]"
                        placeholder="••••••••"
                        @input="checkPasswordStrength($event.target.value)" />
                    
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
                
                {{-- Password strength meter --}}
                <div class="mt-2 space-y-2" x-show="password.length > 0" x-cloak>
                    <div class="flex gap-1 h-1">
                        <div class="flex-1 h-full rounded-full transition-all duration-300" 
                             :class="{
                                'bg-gray-200 dark:bg-gray-700': passwordStrength < 25,
                                'bg-red-500': passwordStrength >= 25 && passwordStrength < 50,
                                'bg-yellow-500': passwordStrength >= 50 && passwordStrength < 75,
                                'bg-green-500': passwordStrength >= 75
                             }"
                             :style="{ width: passwordStrength + '%' }">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 text-xs">
                        <span class="flex items-center gap-1"
                              :class="{ 'text-green-500': passwordStrength >= 25, 'text-[#706f6c]': passwordStrength < 25 }">
                            <svg x-show="passwordStrength >= 25" class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <svg x-show="passwordStrength < 25" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            8+ characters
                        </span>
                        <span class="flex items-center gap-1"
                              :class="{ 'text-green-500': passwordStrength >= 50, 'text-[#706f6c]': passwordStrength < 50 }">
                            <svg x-show="passwordStrength >= 50" class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <svg x-show="passwordStrength < 50" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Uppercase
                        </span>
                        <span class="flex items-center gap-1"
                              :class="{ 'text-green-500': passwordStrength >= 75, 'text-[#706f6c]': passwordStrength < 75 }">
                            <svg x-show="passwordStrength >= 75" class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <svg x-show="passwordStrength < 75" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Numbers/Symbols
                        </span>
                    </div>
                </div>
                
                @error('password')
                    <p class="mt-2 text-sm text-[#f53003]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div data-aos="fade-up" data-aos-delay="250" data-aos-duration="600">
                <label for="password_confirmation" class="block text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2">
                    {{ __('Confirm Password') }}
                </label>
                <div class="relative group">
                    <input id="password_confirmation" 
                        :type="showConfirmPassword ? 'text' : 'password'"
                        name="password_confirmation"
                        x-model="password_confirmation"
                        required 
                        autocomplete="new-password" 
                        class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] focus:ring-1 focus:ring-[#f53003] transition-all duration-300 hover:shadow-lg hover:border-[#f53003] text-[#1b1b18] dark:text-[#EDEDEC]"
                        placeholder="••••••••" />
                    
                    <button type="button" 
                            @click="showConfirmPassword = !showConfirmPassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#706f6c] hover:text-[#f53003] transition-all duration-300 hover:scale-110">
                        <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-[#f53003]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Terms and conditions checkbox --}}
            <div class="flex items-center" data-aos="fade-up" data-aos-delay="300">
                <label class="flex items-center cursor-pointer group">
                    <input id="terms" name="terms" type="checkbox" 
                           x-model="terms"
                           class="h-4 w-4 border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm text-[#f53003] focus:ring-[#f53003] transition-all duration-300 hover:scale-110 group-hover:border-[#f53003]" 
                           required>
                    <span class="ml-2 text-sm text-[#706f6c] dark:text-[#A1A09A] group-hover:text-[#f53003] transition-colors duration-300">
                        I agree to the 
                        <a href="{{ route('terms') }}" class="text-[#f53003] hover:underline font-medium">Terms of Service</a> 
                        and 
                        <a href="{{ route('privacy') }}" class="text-[#f53003] hover:underline font-medium">Privacy Policy</a>
                    </span>
                </label>
            </div>

            <div class="flex flex-col space-y-4" data-aos="fade-up" data-aos-delay="350">
                <button type="submit" 
                        class="w-full justify-center px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white transition-all duration-300 hover:scale-105 hover:shadow-xl font-medium relative overflow-hidden group disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="loading || !terms">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <svg x-show="!loading" class="w-5 h-5 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <svg x-show="loading" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span x-text="loading ? 'Creating Account...' : 'Create Account'"></span>
                    </span>
                    <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </button>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[#e3e3e0] dark:border-[#3E3E3A]"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-[#161615] text-[#706f6c] dark:text-[#A1A09A]">Already have an account?</span>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-[#f53003] hover:underline font-medium group transition-all duration-300 hover:scale-105">
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                        </svg>
                        Sign in to your account
                    </a>
                </div>
            </div>
        </form>

        {{-- Social proof with animations --}}
        <div class="mt-8 pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A]" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center justify-center gap-6 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                <div class="flex items-center gap-2 group cursor-pointer hover:text-[#f53003] transition-all duration-300 hover:scale-110">
                    <div class="relative">
                        <svg class="w-5 h-5 text-[#f53003] group-hover:animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-green-500 rounded-full animate-ping"></span>
                    </div>
                    <span class="font-medium">Free forever</span>
                </div>
                <div class="flex items-center gap-2 group cursor-pointer hover:text-[#f53003] transition-all duration-300 hover:scale-110">
                    <svg class="w-5 h-5 text-[#f53003] group-hover:animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                    <span class="font-medium">Join 10,000+ writers</span>
                </div>
            </div>

            {{-- Testimonial --}}
            <div class="mt-6 p-4 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg text-center group hover:shadow-lg transition-all duration-300 hover:scale-105">
                <p class="text-sm italic text-[#706f6c] dark:text-[#A1A09A]">
                    "This platform helped me find my voice and connect with amazing readers!"
                </p>
                <p class="text-xs mt-2 font-medium text-[#f53003]">— Sarah J., Writer</p>
            </div>
        </div>
    </div>
</x-guest-layout>