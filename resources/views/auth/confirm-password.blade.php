{{-- resources/views/auth/confirm-password.blade.php --}}
<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="flex items-center justify-center gap-2 mb-4">
            <svg class="w-10 h-10 text-[#f53003]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
            <span class="font-bold text-2xl">{{ config('app.name', 'BlogSpace') }}</span>
        </div>
        <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Confirm password</h2>
    </div>

    <div class="mb-6 p-4 bg-[#fff2f2] dark:bg-[#1D0002] rounded-sm text-sm text-[#706f6c] dark:text-[#A1A09A]">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-[#f53003] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</span>
        </div>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Your Password')" class="text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2" />
            <x-text-input id="password" 
                class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-colors text-[#1b1b18] dark:text-[#EDEDEC]"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="Enter your password to continue" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-[#f53003]" />
        </div>

        <div class="flex flex-col space-y-4">
            <x-primary-button class="w-full justify-center px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white transition-colors font-medium">
                {{ __('Confirm Password') }}
            </x-primary-button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to sign in
                </a>
            </div>
        </div>
    </form>

    {{-- Help tip --}}
    <div class="mt-6 text-xs text-center text-[#706f6c] dark:text-[#A1A09A]">
        Having trouble? <a href="{{ route('password.request') }}" class="text-[#f53003] hover:underline">Reset your password</a>
    </div>
</x-guest-layout>