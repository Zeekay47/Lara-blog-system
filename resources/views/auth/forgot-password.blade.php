{{-- resources/views/auth/forgot-password.blade.php --}}
<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="flex items-center justify-center gap-2 mb-4">
            <svg class="w-10 h-10 text-[#f53003]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
            <span class="font-bold text-2xl">{{ config('app.name', 'BlogSpace') }}</span>
        </div>
        <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Reset password</h2>
    </div>

    <div class="mb-6 p-4 bg-[#fff2f2] dark:bg-[#1D0002] rounded-sm text-sm text-[#706f6c] dark:text-[#A1A09A]">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-[#f53003] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</span>
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-[#1b1b18] dark:text-[#EDEDEC] text-sm font-medium mb-2" />
            <x-text-input id="email" 
                class="block mt-1 w-full px-4 py-3 border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] transition-colors text-[#1b1b18] dark:text-[#EDEDEC]" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                placeholder="lbs@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-[#f53003]" />
        </div>

        <div class="flex flex-col space-y-4">
            <x-primary-button class="w-full justify-center px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white transition-colors font-medium">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ __('Send Reset Link') }}
                </span>
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

    {{-- Help contact --}}
    <div class="mt-6 text-xs text-center text-[#706f6c] dark:text-[#A1A09A]">
        Still having trouble? <a href="{{ route('contact') }}" class="text-[#f53003] hover:underline">Contact support</a>
    </div>
</x-guest-layout>