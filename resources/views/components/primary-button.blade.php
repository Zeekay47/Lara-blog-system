{{-- resources/views/components/primary-button.blade.php --}}
@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] border border-transparent rounded-sm font-semibold text-xs text-white dark:text-[#1C1C1A] uppercase tracking-widest hover:bg-black dark:hover:bg-white focus:bg-black dark:focus:bg-white active:bg-black dark:active:bg-white focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:ring-offset-2 dark:focus:ring-offset-[#161615] transition ease-in-out duration-150']) !!}>
    {{ $slot }}
</button>