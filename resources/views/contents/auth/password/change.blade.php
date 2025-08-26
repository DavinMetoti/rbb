@extends('app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <div class="text-center">
                    <h1 class="text-2xl font-light text-gray-900 mb-2">{{ __('messages.change_password') ?? 'Ubah Password' }}</h1>
                    <p class="text-gray-500 text-sm">{{ __('messages.change_password_desc') ?? 'Masukkan password saat ini dan password baru' }}</p>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-green-700 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-red-700 font-medium mb-2">{{ __('messages.please_correct_errors') ?? 'Mohon perbaiki kesalahan berikut' }}</h3>
                            <ul class="text-red-600 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Password Change Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Current Password -->
                    <div class="space-y-1">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">
                            {{ __('messages.current_password') ?? 'Password Saat Ini' }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password" 
                                   required
                                   class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('current_password') border-red-300 @enderror" 
                                   placeholder="{{ __('messages.enter_current_password') ?? 'Masukkan password saat ini' }}">
                            <button type="button" 
                                    onclick="togglePasswordVisibility('current_password')"
                                    class="absolute right-4 top-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-5 h-5" id="current_password_show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg class="w-5 h-5 hidden" id="current_password_hide" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                </svg>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="space-y-1">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">
                            {{ __('messages.new_password') ?? 'Password Baru' }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="new_password" 
                                   id="new_password" 
                                   required
                                   class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('new_password') border-red-300 @enderror" 
                                   placeholder="{{ __('messages.enter_new_password') ?? 'Masukkan password baru' }}">
                            <button type="button" 
                                    onclick="togglePasswordVisibility('new_password')"
                                    class="absolute right-4 top-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-5 h-5" id="new_password_show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg class="w-5 h-5 hidden" id="new_password_hide" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                </svg>
                            </button>
                        </div>
                        @error('new_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">{{ __('messages.password_requirements') ?? 'Password minimal 8 karakter' }}</p>
                    </div>

                    <!-- Confirm New Password -->
                    <div class="space-y-1">
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                            {{ __('messages.confirm_new_password') ?? 'Konfirmasi Password Baru' }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="new_password_confirmation" 
                                   id="new_password_confirmation" 
                                   required
                                   class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="{{ __('messages.confirm_new_password_placeholder') ?? 'Masukkan ulang password baru' }}">
                            <button type="button" 
                                    onclick="togglePasswordVisibility('new_password_confirmation')"
                                    class="absolute right-4 top-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-5 h-5" id="new_password_confirmation_show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg class="w-5 h-5 hidden" id="new_password_confirmation_hide" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Password Strength Indicator -->
                    <div class="space-y-2">
                        <div class="text-xs text-gray-600">{{ __('messages.password_strength') ?? 'Kekuatan Password:' }}</div>
                        <div class="flex space-x-1">
                            <div class="h-2 flex-1 bg-gray-200 rounded"></div>
                            <div class="h-2 flex-1 bg-gray-200 rounded"></div>
                            <div class="h-2 flex-1 bg-gray-200 rounded"></div>
                            <div class="h-2 flex-1 bg-gray-200 rounded"></div>
                        </div>
                        <div class="text-xs text-gray-500" id="password-strength-text">{{ __('messages.enter_password_to_check') ?? 'Masukkan password untuk mengecek kekuatan' }}</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex space-x-4 pt-4">
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span>{{ __('messages.change_password') ?? 'Ubah Password' }}</span>
                            </span>
                        </button>
                        
                        <a href="{{ route('participants.index') }}" 
                           class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-200 text-center">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>{{ __('messages.cancel') ?? 'Batal' }}</span>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const showIcon = document.getElementById(fieldId + '_show');
            const hideIcon = document.getElementById(fieldId + '_hide');
            
            if (field.type === 'password') {
                field.type = 'text';
                showIcon.classList.add('hidden');
                hideIcon.classList.remove('hidden');
            } else {
                field.type = 'password';
                showIcon.classList.remove('hidden');
                hideIcon.classList.add('hidden');
            }
        }

        // Password strength checker
        document.getElementById('new_password').addEventListener('input', function() {
            const password = this.value;
            const strengthBars = document.querySelectorAll('.h-2.flex-1');
            const strengthText = document.getElementById('password-strength-text');
            
            let score = 0;
            let feedback = '';
            
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;
            
            // Reset all bars
            strengthBars.forEach(bar => {
                bar.className = 'h-2 flex-1 bg-gray-200 rounded';
            });
            
            // Color bars based on strength
            if (score >= 1) {
                strengthBars[0].className = 'h-2 flex-1 bg-red-400 rounded';
                feedback = '{{ __("messages.weak_password") ?? "Lemah" }}';
            }
            if (score >= 2) {
                strengthBars[1].className = 'h-2 flex-1 bg-orange-400 rounded';
                feedback = '{{ __("messages.fair_password") ?? "Sedang" }}';
            }
            if (score >= 3) {
                strengthBars[2].className = 'h-2 flex-1 bg-yellow-400 rounded';
                feedback = '{{ __("messages.good_password") ?? "Baik" }}';
            }
            if (score >= 4) {
                strengthBars[3].className = 'h-2 flex-1 bg-green-400 rounded';
                feedback = '{{ __("messages.strong_password") ?? "Kuat" }}';
            }
            
            if (password.length === 0) {
                feedback = '{{ __("messages.enter_password_to_check") ?? "Masukkan password untuk mengecek kekuatan" }}';
            }
            
            strengthText.textContent = feedback;
        });

        // Real-time password confirmation validation
        document.getElementById('new_password_confirmation').addEventListener('input', function() {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && newPassword !== confirmPassword) {
                this.classList.add('border-red-300');
                this.classList.remove('border-gray-200');
            } else {
                this.classList.remove('border-red-300');
                this.classList.add('border-gray-200');
            }
        });
    </script>
@endsection
