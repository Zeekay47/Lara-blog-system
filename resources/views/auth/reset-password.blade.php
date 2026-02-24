{{-- resources/views/auth/reset-password.blade.php --}}
<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="flex items-center justify-center gap-2 mb-4">
            <svg class="w-10 h-10 text-[#f53003]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
            <span class="font-bold text-2xl">{{ config('app.name', 'BlogSpace') }}</span>
        </div>
        <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Create new password</h2>
        <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mt-2">Please choose a new strong password for your account</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2" />
            <x-text-input id="email" 
                class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-colors text-[#1b1b18] dark:text-[#EDEDEC]" 
                type="email" 
                name="email" 
                :value="old('email', $request->email)" 
                required 
                autofocus 
                autocomplete="username" 
                readonly 
                class="bg-gray-50 dark:bg-gray-800 cursor-not-allowed" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-[#f53003]" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" class="text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2" />
            <x-text-input id="password" 
                class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-colors text-[#1b1b18] dark:text-[#EDEDEC]"
                type="password"
                name="password"
                required 
                autocomplete="new-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-[#f53003]" />
            
            {{-- Password strength requirements --}}
            <div class="mt-2 grid grid-cols-2 gap-2 text-xs">
                <div class="flex items-center gap-1 text-[#706f6c] dark:text-[#A1A09A]">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>At least 8 characters</span>
                </div>
                <div class="flex items-center gap-1 text-[#706f6c] dark:text-[#A1A09A]">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Include uppercase & lowercase</span>
                </div>
                <div class="flex items-center gap-1 text-[#706f6c] dark:text-[#A1A09A]">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Include numbers</span>
                </div>
                <div class="flex items-center gap-1 text-[#706f6c] dark:text-[#A1A09A]">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Include special characters</span>
                </div>
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2" />
            <x-text-input id="password_confirmation" 
                class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-colors text-[#1b1b18] dark:text-[#EDEDEC]"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-[#f53003]" />
        </div>

        <div class="flex flex-col space-y-4">
            <x-primary-button class="w-full justify-center px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white transition-colors font-medium">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    {{ __('Reset Password') }}
                </span>
            </x-primary-button>
        </div>
    </form>

    {{-- Security note --}}
    <div class="mt-6 p-3 bg-[#fff2f2] dark:bg-[#1D0002] rounded-sm">
        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] flex items-start gap-2">
            <svg class="w-4 h-4 text-[#f53003] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span>For security reasons, please choose a strong password that you don't use for other websites.</span>
        </p>
    </div>
</x-guest-layout>