{{-- resources/views/components/text-input.blade.php --}}
@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-[#e3e3e0] dark:border-[#3E3E3A] dark:bg-[#161615] dark:text-[#EDEDEC] focus:border-[#f53003] dark:focus:border-[#FF4433] focus:ring-[#f53003] dark:focus:ring-[#FF4433] rounded-sm shadow-sm']) !!}>
