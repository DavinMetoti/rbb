@extends('app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <div class="text-center">
                    <h1 class="text-3xl font-light text-gray-900 mb-2">{{ __('messages.add_participant') }}</h1>
                    <p class="text-gray-500 text-sm">{{ __('messages.fill_participant_info') }}</p>
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

            <!-- Error Message -->
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-700 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-red-700 font-medium mb-2">{{ __('messages.please_correct_errors') }}</h3>
                            <ul class="text-red-600 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('participants.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.personal_information') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Basic Info -->
                        <div class="space-y-1">
                            <label for="code" class="block text-sm font-medium text-gray-700">{{ __('messages.code') }}</label>
                            <input type="text" name="code" id="code" value="{{ old('code') }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('code') border-red-300 @enderror" 
                                   placeholder="{{ __('messages.enter_code') }}" required>
                            @error('code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('messages.full_name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('name') border-red-300 @enderror" 
                                   placeholder="{{ __('messages.enter_name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="gender" class="block text-sm font-medium text-gray-700">{{ __('messages.gender') }}</label>
                            <select name="gender" id="gender" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('gender') border-red-300 @enderror" required>
                                <option value="">{{ __('messages.select_gender') }}</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ __('messages.other') }}</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="birth_date" class="block text-sm font-medium text-gray-700">{{ __('messages.birth_date') }}</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('birth_date') border-red-300 @enderror" required>
                            @error('birth_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="nationality" class="block text-sm font-medium text-gray-700">{{ __('messages.nationality') }}</label>
                            <select name="nationality" id="nationality" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('nationality') border-red-300 @enderror" required>
                                <option value="">{{ __('messages.select_nationality') }}</option>
                                <option value="Indonesian" {{ old('nationality') == 'Indonesian' ? 'selected' : '' }}>{{ __('messages.indonesian') }}</option>
                                <option value="Malaysian" {{ old('nationality') == 'Malaysian' ? 'selected' : '' }}>{{ __('messages.malaysian') }}</option>
                                <option value="Filipino" {{ old('nationality') == 'Filipino' ? 'selected' : '' }}>{{ __('messages.filipino') }}</option>
                                <option value="Thai" {{ old('nationality') == 'Thai' ? 'selected' : '' }}>{{ __('messages.thai') }}</option>
                                <option value="Vietnamese" {{ old('nationality') == 'Vietnamese' ? 'selected' : '' }}>{{ __('messages.vietnamese') }}</option>
                                <option value="Cambodian" {{ old('nationality') == 'Cambodian' ? 'selected' : '' }}>{{ __('messages.cambodian') }}</option>
                                <option value="Myanmar" {{ old('nationality') == 'Myanmar' ? 'selected' : '' }}>{{ __('messages.myanmar') }}</option>
                                <option value="Indian" {{ old('nationality') == 'Indian' ? 'selected' : '' }}>{{ __('messages.indian') }}</option>
                                <option value="Sri Lankan" {{ old('nationality') == 'Sri Lankan' ? 'selected' : '' }}>{{ __('messages.sri_lankan') }}</option>
                                <option value="Other" {{ old('nationality') == 'Other' ? 'selected' : '' }}>{{ __('messages.other') }}</option>
                            </select>
                            @error('nationality')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="religion" class="block text-sm font-medium text-gray-700">{{ __('messages.religion') }}</label>
                            <select name="religion" id="religion" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('religion') border-red-300 @enderror" required>
                                <option value="">{{ __('messages.select_religion') }}</option>
                                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>{{ __('messages.islam') }}</option>
                                <option value="Christian" {{ old('religion') == 'Christian' ? 'selected' : '' }}>{{ __('messages.christian') }}</option>
                                <option value="Catholic" {{ old('religion') == 'Catholic' ? 'selected' : '' }}>{{ __('messages.catholic') }}</option>
                                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>{{ __('messages.hindu') }}</option>
                                <option value="Buddhist" {{ old('religion') == 'Buddhist' ? 'selected' : '' }}>{{ __('messages.buddhist') }}</option>
                                <option value="Confucian" {{ old('religion') == 'Confucian' ? 'selected' : '' }}>{{ __('messages.confucian') }}</option>
                                <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>{{ __('messages.other') }}</option>
                            </select>
                            @error('religion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Physical Information Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.physical_information') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="space-y-1">
                            <label for="height" class="block text-sm font-medium text-gray-700">{{ __('messages.height') }}</label>
                            <div class="relative">
                                <input type="number" name="height" id="height" value="{{ old('height') }}"
                                       class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('height') border-red-300 @enderror" 
                                       placeholder="0" required>
                                <span class="absolute right-4 top-3 text-gray-400 text-sm">cm</span>
                            </div>
                            @error('height')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="weight" class="block text-sm font-medium text-gray-700">{{ __('messages.weight') }}</label>
                            <div class="relative">
                                <input type="number" name="weight" id="weight" value="{{ old('weight') }}"
                                       class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('weight') border-red-300 @enderror" 
                                       placeholder="0" required>
                                <span class="absolute right-4 top-3 text-gray-400 text-sm">kg</span>
                            </div>
                            @error('weight')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Personal Status Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.personal_status') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="space-y-1">
                            <label for="marital_status" class="block text-sm font-medium text-gray-700">{{ __('messages.marital') }}</label>
                            <select name="marital_status" id="marital_status" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('marital_status') border-red-300 @enderror" required>
                                <option value="">{{ __('messages.select_status') }}</option>
                                <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>{{ __('messages.single') }}</option>
                                <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>{{ __('messages.married') }}</option>
                                <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>{{ __('messages.divorced') }}</option>
                                <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>{{ __('messages.widowed') }}</option>
                            </select>
                            @error('marital_status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="education" class="block text-sm font-medium text-gray-700">{{ __('messages.education') }}</label>
                            <select name="education" id="education" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('education') border-red-300 @enderror" required>
                                <option value="">{{ __('messages.select_education') }}</option>
                                <option value="Elementary School" {{ old('education') == 'Elementary School' ? 'selected' : '' }}>{{ __('messages.elementary_school') }}</option>
                                <option value="Primary High School" {{ old('education') == 'Primary High School' ? 'selected' : '' }}>{{ __('messages.primary_high_school') }}</option>
                                <option value="Junior High School" {{ old('education') == 'Junior High School' ? 'selected' : '' }}>{{ __('messages.junior_high_school') }}</option>
                                <option value="Senior High School" {{ old('education') == 'Senior High School' ? 'selected' : '' }}>{{ __('messages.senior_high_school') }}</option>
                                <option value="Vocational School" {{ old('education') == 'Vocational School' ? 'selected' : '' }}>{{ __('messages.vocational_school') }}</option>
                                <option value="Diploma" {{ old('education') == 'Diploma' ? 'selected' : '' }}>{{ __('messages.diploma') }}</option>
                                <option value="Bachelor Degree" {{ old('education') == 'Bachelor Degree' ? 'selected' : '' }}>{{ __('messages.bachelor_degree') }}</option>
                                <option value="Master Degree" {{ old('education') == 'Master Degree' ? 'selected' : '' }}>{{ __('messages.master_degree') }}</option>
                                <option value="Doctorate Degree" {{ old('education') == 'Doctorate Degree' ? 'selected' : '' }}>{{ __('messages.doctorate_degree') }}</option>
                                <option value="Other" {{ old('education') == 'Other' ? 'selected' : '' }}>{{ __('messages.other') }}</option>
                            </select>
                            @error('education')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="no_of_children" class="block text-sm font-medium text-gray-700">{{ __('messages.number_of_children') }}</label>
                            <input type="text" name="no_of_children" id="no_of_children" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="BOY 9 Y.O">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('messages.current_status') }}</label>
                            <select name="status" id="status" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('status') border-red-300 @enderror" required>
                                <option value="">{{ __('messages.select_status') }}</option>
                                <option value="OVERSEAS HELPER" {{ old('status') == 'OVERSEAS HELPER' ? 'selected' : '' }}>{{ __('messages.overseas_helper') }}</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Work Experience Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.work_experience_years') }}</h2>
                    <p class="text-sm text-gray-500 mb-4">{{ __('messages.no_experience_note') }}</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                        <div class="space-y-1">
                            <label for="hongkong_year" class="block text-sm font-medium text-gray-700">{{ __('messages.hong_kong') }}</label>
                            <input type="number" name="hongkong_year" id="hongkong_year" value="{{ old('hongkong_year', 0) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="singapore_year" class="block text-sm font-medium text-gray-700">{{ __('messages.singapore') }}</label>
                            <input type="number" name="singapore_year" id="singapore_year" value="{{ old('singapore_year', 0) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="taiwan_year" class="block text-sm font-medium text-gray-700">{{ __('messages.taiwan') }}</label>
                            <input type="number" name="taiwan_year" id="taiwan_year" value="{{ old('taiwan_year', 0) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="malaysia_year" class="block text-sm font-medium text-gray-700">{{ __('messages.malaysia') }}</label>
                            <input type="number" name="malaysia_year" id="malaysia_year" value="{{ old('malaysia_year', 0) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="brunei_year" class="block text-sm font-medium text-gray-700">{{ __('messages.brunei') }}</label>
                            <input type="number" name="brunei_year" id="brunei_year" value="{{ old('brunei_year', 0) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                    </div>
                </div>

                <!-- Language Skills Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.language_skills') }}</h2>
                    <p class="text-sm text-gray-500 mb-4">{{ __('messages.no_language_note') }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-1">
                            <label for="cantonese" class="block text-sm font-medium text-gray-700">{{ __('messages.cantonese') }}</label>
                            <select name="cantonese" id="cantonese" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white">
                                <option value="">{{ __('messages.no_knowledge') }} / {{ __('messages.select_level') }}</option>
                                <option value="learning" {{ old('cantonese') == 'learning' ? 'selected' : '' }}>{{ __('messages.learning') }}</option>
                                <option value="basic" {{ old('cantonese') == 'basic' ? 'selected' : '' }}>{{ __('messages.basic') }}</option>
                                <option value="good" {{ old('cantonese') == 'good' ? 'selected' : '' }}>{{ __('messages.good') }}</option>
                            </select>
                        </div>
                        
                        <div class="space-y-1">
                            <label for="mandarine" class="block text-sm font-medium text-gray-700">{{ __('messages.chinese') }}</label>
                            <select name="mandarine" id="mandarine" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white">
                                <option value="">{{ __('messages.no_knowledge') }} / {{ __('messages.select_level') }}</option>
                                <option value="learning" {{ old('mandarine') == 'learning' ? 'selected' : '' }}>{{ __('messages.learning') }}</option>
                                <option value="basic" {{ old('mandarine') == 'basic' ? 'selected' : '' }}>{{ __('messages.basic') }}</option>
                                <option value="good" {{ old('mandarine') == 'good' ? 'selected' : '' }}>{{ __('messages.good') }}</option>
                            </select>
                        </div>
                        
                        <div class="space-y-1">
                            <label for="english" class="block text-sm font-medium text-gray-700">{{ __('messages.english') }}</label>
                            <select name="english" id="english" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white">
                                <option value="">{{ __('messages.no_knowledge') }} / {{ __('messages.select_level') }}</option>
                                <option value="learning" {{ old('english') == 'learning' ? 'selected' : '' }}>{{ __('messages.learning') }}</option>
                                <option value="basic" {{ old('english') == 'basic' ? 'selected' : '' }}>{{ __('messages.basic') }}</option>
                                <option value="good" {{ old('english') == 'good' ? 'selected' : '' }}>{{ __('messages.good') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Work History Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-100">
                        <h2 class="text-lg font-medium text-gray-900">{{ __('messages.work_history') }}</h2>
                        <button type="button" id="add-work-history" 
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-900 transition-all duration-200 text-sm font-medium">
                            <span class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span>{{ __('messages.add_work_history') }}</span>
                            </span>
                        </button>
                    </div>
                    
                    <div id="work-history-container">
                        <!-- Initial work history entry -->
                        <div class="work-history-entry border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-base font-medium text-gray-800">{{ __('messages.work_history_number', ['number' => 1]) }}</h3>
                                <button type="button" class="remove-work-history text-red-500 hover:text-red-700 focus:outline-none" style="display: none;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('messages.country') }}</label>
                                    <input type="text" name="work_history[0][country]" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                           placeholder="{{ __('messages.enter_country') }}">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('messages.period') }}</label>
                                    <input type="text" name="work_history[0][period]" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                           placeholder="e.g., 2020-2022">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('messages.target_employer') }}</label>
                                    <input type="text" name="work_history[0][target]" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                           placeholder="{{ __('messages.enter_employer') }}">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('messages.reason_for_leaving') }}</label>
                                    <input type="text" name="work_history[0][reason_for_leaving]" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                           placeholder="{{ __('messages.enter_reason') }}">
                                </div>
                                <div class="space-y-1 md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('messages.remarks') }}</label>
                                    <textarea name="work_history[0][remake]" rows="3"
                                              class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white resize-none" 
                                              placeholder="{{ __('messages.additional_remarks') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Skills & Experience Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.skills_experience') }}</h2>
                    
                    <div class="space-y-3">
                        @php
                            $allExperience = [
                                'elderly_healthy_care_experience' => 'ELDERLY HEALTHY CARE EXPERIENCE',
                                'elderly_sick_care_experience' => 'ELDERLY SICK CARE EXPERIENCE',
                                'elderly_healthy_care_experience_v' => 'ELDERLY HEALTHY CARE EXPERIENCE (VERIFIED)',
                                'elderly_sick_care_experience_v' => 'ELDERLY SICK CARE EXPERIENCE (VERIFIED)',
                                'newborn_care_experience' => 'NEWBORN CARE EXPERIENCE',
                                'children_care_experience' => 'CHILDREN CARE EXPERIENCE',
                                'i_can_take_care_of_dog' => 'I CAN TAKE CARE OF DOG',
                                'i_can_take_care_of_cat' => 'I CAN TAKE CARE OF CAT',
                                'cooking_cleaning_washing_ironing_go_to_market' => 'COOKING\' CLEANING\' WASHING\' IRONING GO TO MARKET',
                                'i_can_wash_car' => 'I CAN WASH CAR',
                                'shuttle_school' => 'SHUTTLE SCHOOL',
                                'assist_toileting_change_diaper_bath_experience' => 'ASSIST TOILETING\' CHANGE DIAPER\' BATH EXPERIENCE',
                                'go_to_hospital_handle_medication_experience' => 'GO TO HOSPITAL\' HANDLE MEDICATION EXPERIENCE',
                                'do_exercise' => 'DO EXERCISE',
                                'use_wheelchair' => 'USE WHEELCHAIR',
                                'provide_daily_assistance' => 'PROVIDE DAILY ASSISTANCE',
                                'oral_feeding' => 'ORAL FEEDING',
                                'with_dementia_care_experience' => 'WITH DEMENTIA CARE EXPERIENCE',
                                'assist_walking' => 'ASSIST WALKING',
                                'received_covid19_vaccine_injection_3_dose' => 'RECEIVED COVID-19 VACCINE INJECTION (3 DOSE)',
                                'i_can_inject_diabetes' => 'I CAN INJECT DIABETES',
                                'i_can_take_care_of_idiots' => 'I CAN TAKE CARE OF IDIOTS',
                                'suction_phlegm_ican_do_it' => 'SUCTION PHLEGM I CAN DO IT',
                                'i_like_take_care_of_a_children' => 'I LIKE TAKE CARE OF A CHILDREN',
                                'i_like_take_care_of_a_newborn_baby' => 'I LIKE TAKE CARE OF A NEWBORN BABY',
                                'i_like_take_care_of_the_elderly' => 'I LIKE TAKE CARE OF THE ELDERLY',
                            ];
                        @endphp
                        @foreach($allExperience as $field => $label)
                            <label class="flex items-center space-x-3 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors duration-200">
                                <input type="checkbox" name="{{ $field }}" value="1" 
                                       {{ old($field) ? 'checked' : '' }}
                                       class="w-4 h-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900 focus:ring-2">
                                <span class="text-sm text-gray-700 font-medium">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- New Job & Date Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.new_job') }} & {{ __('messages.date') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label for="new_job" class="block text-sm font-medium text-gray-700">{{ __('messages.new_job') }}</label>
                            <input type="text" name="new_job" id="new_job" value="{{ old('new_job') }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('new_job') border-red-300 @enderror"
                                   placeholder="Enter new job">
                            @error('new_job')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="date" class="block text-sm font-medium text-gray-700">{{ __('messages.date') }}</label>
                            <input type="date" name="date" id="date" value="{{ old('date') }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('date') border-red-300 @enderror">
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Photo Upload Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.photo_upload') }}</h2>
                    <div class="space-y-1">
                        <label for="photo_path" class="block text-sm font-medium text-gray-700">{{ __('messages.participant_photo') }} <span class="text-gray-500 text-xs">({{ __('messages.optional') }})</span></label>
                        <div class="mt-2">
                            <input type="file" name="photo_path" id="photo_path" accept="image/*"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 file:cursor-pointer cursor-pointer border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 @error('photo_path') border-red-300 @enderror">
                        </div>
                        @error('photo_path')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">{{ __('messages.photo_upload_note') }}</p>
                    </div>
                </div>

                <!-- Public Visibility Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.visibility_settings') }}</h2>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_public" id="is_public" value="1" 
                                   {{ old('is_public', true) ? 'checked' : '' }}
                                   class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-300 rounded focus:ring-gray-900 focus:ring-2">
                            <label for="is_public" class="ml-3 text-sm font-medium text-gray-700">
                                {{ __('messages.make_profile_public') }}
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 ml-8">{{ __('messages.public_profile_note') }}</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center pt-6">
                    <button type="submit" 
                            class="px-8 py-4 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        <span class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>{{ __('messages.add_participant') }}</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let workHistoryIndex = 1;
            const container = document.getElementById('work-history-container');
            const addButton = document.getElementById('add-work-history');

            // Function to update remove button visibility
            function updateRemoveButtons() {
                const entries = container.querySelectorAll('.work-history-entry');
                entries.forEach(entry => {
                    const removeButton = entry.querySelector('.remove-work-history');
                    if (entries.length > 1) {
                        removeButton.style.display = 'block';
                    } else {
                        removeButton.style.display = 'none';
                    }
                });
            }

            // Function to update entry numbers
            function updateEntryNumbers() {
                const entries = container.querySelectorAll('.work-history-entry');
                entries.forEach((entry, index) => {
                    const title = entry.querySelector('h3');
                    title.textContent = `{{ __('messages.work_history') }} #${index + 1}`;
                    
                    // Update input names
                    const inputs = entry.querySelectorAll('input, textarea');
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            const newName = name.replace(/\[\d+\]/, `[${index}]`);
                            input.setAttribute('name', newName);
                        }
                    });
                });
            }

            // Add work history entry
            addButton.addEventListener('click', function() {
                const newEntry = document.createElement('div');
                newEntry.className = 'work-history-entry border border-gray-200 rounded-lg p-4 mb-4';
                
                newEntry.innerHTML = `
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-medium text-gray-800">{{ __('messages.work_history') }} #${workHistoryIndex + 1}</h3>
                        <button type="button" class="remove-work-history text-red-500 hover:text-red-700 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.country') }}</label>
                            <input type="text" name="work_history[${workHistoryIndex}][country]" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="{{ __('messages.enter_country') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.period') }}</label>
                            <input type="text" name="work_history[${workHistoryIndex}][period]" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="e.g., 2020-2022">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.target_employer') }}</label>
                            <input type="text" name="work_history[${workHistoryIndex}][target]" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="{{ __('messages.enter_employer') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.reason_for_leaving') }}</label>
                            <input type="text" name="work_history[${workHistoryIndex}][reason_for_leaving]" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="{{ __('messages.enter_reason') }}">
                        </div>
                        <div class="space-y-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.remarks') }}</label>
                            <textarea name="work_history[${workHistoryIndex}][remake]" rows="3"
                                      class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white resize-none" 
                                      placeholder="{{ __('messages.additional_remarks') }}"></textarea>
                        </div>
                    </div>
                `;

                container.appendChild(newEntry);
                workHistoryIndex++;
                updateRemoveButtons();
                updateEntryNumbers();

                // Add remove functionality to the new entry
                const removeButton = newEntry.querySelector('.remove-work-history');
                removeButton.addEventListener('click', function() {
                    newEntry.remove();
                    updateRemoveButtons();
                    updateEntryNumbers();
                });

                // Smooth scroll to the new entry
                newEntry.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });

            // Add remove functionality to existing entries
            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-work-history')) {
                    const entry = e.target.closest('.work-history-entry');
                    entry.remove();
                    updateRemoveButtons();
                    updateEntryNumbers();
                }
            });

            // Initial setup
            updateRemoveButtons();
        });
    </script>
@endsection
