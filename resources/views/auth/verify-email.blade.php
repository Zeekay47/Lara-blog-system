<x-guest-layout>
    <div x-data="{ 
        code: ['', '', '', '', ''],
        loading: false,
        resendLoading: false,
        timer: 600, // 10 minutes in seconds
        timerInterval: null,
        
        init() {
            this.startTimer();
            this.focusFirst();
        },
        
        startTimer() {
            this.timerInterval = setInterval(() => {
                if (this.timer > 0) {
                    this.timer--;
                } else {
                    clearInterval(this.timerInterval);
                }
            }, 1000);
        },
        
        formatTime() {
            const minutes = Math.floor(this.timer / 60);
            const seconds = this.timer % 60;
            return `${minutes}:${seconds.toString().padStart(2, '0')}`;
        },
        
        focusFirst() {
            this.$nextTick(() => {
                this.$refs.code0.focus();
            });
        },
        
        handleInput(index, event) {
            // Only allow numbers
            this.code[index] = event.target.value.replace(/[^0-9]/g, '');
            
            // Auto-focus next input
            if (this.code[index] && index < 4) {
                this.$refs[`code${index + 1}`].focus();
            }
        },
        
        handleKeydown(index, event) {
            // Handle backspace
            if (event.key === 'Backspace' && !this.code[index] && index > 0) {
                this.$refs[`code${index - 1}`].focus();
            }
            
            // Handle left arrow
            if (event.key === 'ArrowLeft' && index > 0) {
                this.$refs[`code${index - 1}`].focus();
            }
            
            // Handle right arrow
            if (event.key === 'ArrowRight' && index < 4) {
                this.$refs[`code${index + 1}`].focus();
            }
        },
        
        handlePaste(event) {
            event.preventDefault();
            const pasteData = event.clipboardData.getData('text').replace(/[^0-9]/g, '');
            
            if (pasteData.length >= 5) {
                // Paste all 5 digits
                for (let i = 0; i < 5; i++) {
                    this.code[i] = pasteData[i];
                }
                this.$refs.code4.focus();
            }
        },
        
        submitForm() {
            if (this.code.some(digit => digit === '')) {
                alert('Please enter all 5 digits');
                return;
            }
            
            this.loading = true;
            document.getElementById('verification_code').value = this.code.join('');
            this.$refs.verifyForm.submit();
        },
        
        resendCode() {
            this.resendLoading = true;
            this.$refs.resendForm.submit();
        }
    }" class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" x-init="init">
        
        <div class="max-w-md w-full space-y-8" data-aos="fade-up" data-aos-duration="800">
            <div class="text-center">
                <div class="flex items-center justify-center gap-2 mb-4 group">
                    <svg class="w-12 h-12 text-[#f53003] transition-transform duration-500 group-hover:rotate-180" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Verify Your Email</h2>
                <p class="mt-2 text-[#706f6c] dark:text-[#A1A09A]">
                    We've sent a 5-digit verification code to<br>
                    <span class="font-medium text-[#f53003]">{{ session('verification_email') }}</span>
                </p>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="rounded-sm bg-green-50 dark:bg-green-900/20 p-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Error Message -->
            @if ($errors->any())
                <div class="rounded-sm bg-red-50 dark:bg-red-900/20 p-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            @foreach ($errors->all() as $error)
                                <p class="text-sm text-red-700 dark:text-red-300">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Verification Code Input Form -->
            <div class="mt-8 space-y-6" data-aos="fade-up" data-aos-delay="200">
                <form method="POST" action="{{ route('register.verify') }}" x-ref="verifyForm">
                    @csrf
                    <input type="hidden" name="verification_code" id="verification_code">
                    
                    <div>
                        <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4 text-center">
                            Enter 5-Digit Verification Code
                        </label>
                        
                        <div class="flex justify-center gap-2" @paste="handlePaste">
                            <template x-for="(digit, index) in 5" :key="index">
                                <input
                                    :ref="'code' + index"
                                    type="text"
                                    inputmode="numeric"
                                    maxlength="1"
                                    x-model="code[index]"
                                    @input="handleInput(index, $event)"
                                    @keydown="handleKeydown(index, $event)"
                                    class="w-14 h-14 text-center text-2xl font-bold border-2 border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] rounded-sm focus:outline-none focus:border-[#f53003] focus:ring-2 focus:ring-[#f53003] transition-all duration-300 text-[#1b1b18] dark:text-[#EDEDEC]"
                                    :class="{ 'border-[#f53003] ring-2 ring-[#f53003]': code[index] }"
                                    :disabled="loading"
                                />
                            </template>
                        </div>

                        <!-- Timer -->
                        <div class="mt-4 text-center">
                            <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                Code expires in 
                                <span class="font-mono font-bold text-[#f53003]" x-text="formatTime()"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Verify Button -->
                    <div class="flex flex-col space-y-3 mt-6">
                        <button
                            type="button"
                            @click="submitForm"
                            :disabled="loading || code.some(digit => digit === '')"
                            class="w-full justify-center px-6 py-3 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm hover:bg-black dark:hover:bg-white transition-all duration-300 hover:scale-105 hover:shadow-xl font-medium relative overflow-hidden group disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg x-show="!loading" class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <svg x-show="loading" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <span x-text="loading ? 'Verifying...' : 'Verify Code'"></span>
                            </span>
                            <span class="absolute inset-0 bg-gradient-to-r from-[#f53003] to-[#ff8a5c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        </button>
                    </div>
                </form>

                <!-- Resend Code Form -->
                <form method="POST" action="{{ route('register.resend') }}" x-ref="resendForm">
                    @csrf
                    <button
                        type="button"
                        @click="resendCode"
                        :disabled="resendLoading || timer > 0"
                        class="w-full justify-center px-6 py-3 bg-transparent border-2 border-[#f53003] text-[#f53003] rounded-sm hover:bg-[#fff2f2] dark:hover:bg-[#1D0002] transition-all duration-300 hover:scale-105 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span class="flex items-center justify-center gap-2">
                            <svg x-show="!resendLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <svg x-show="resendLoading" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <span x-text="resendLoading ? 'Sending...' : (timer > 0 ? `Resend Code (${formatTime()})` : 'Resend Code')"></span>
                        </span>
                    </button>
                </form>

                <!-- Back to Register -->
                <div class="text-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#f53003] transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Back to Registration</span>
                    </a>
                </div>
            </div>

            <!-- Help Text -->
            <div class="mt-8 p-4 bg-[#fff2f2] dark:bg-[#1D0002] rounded-lg" data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Didn't receive the code?</h3>
                <ul class="text-xs text-[#706f6c] dark:text-[#A1A09A] space-y-1 list-disc list-inside">
                    <li>Check your spam/junk folder</li>
                    <li>Make sure you entered the correct email address</li>
                    <li>The code expires in 10 minutes - request a new one if needed</li>
                </ul>
            </div>
        </div>
    </div>
</x-guest-layout>