@extends('app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <div class="text-center">
                    <h1 class="text-3xl font-light text-gray-900 mb-2">{{ __('messages.edit_participant') }}</h1>
                    <p class="text-gray-500 text-sm">{{ __('messages.update_participant_info') }}</p>
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

            <form action="{{ route('participants.update', $participant->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Personal Information Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.personal_information') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Basic Info -->
                        <div class="space-y-1">
                            <label for="code" class="block text-sm font-medium text-gray-700">{{ __('messages.code') }}</label>
                            <input type="text" name="code" id="code" value="{{ old('code', $participant->code) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('code') border-red-300 @enderror" 
                                   placeholder="{{ __('messages.enter_code') }}" required>
                            @error('code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('messages.full_name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $participant->name) }}"
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
                                <option value="male" {{ old('gender', $participant->gender) == 'male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                                <option value="female" {{ old('gender', $participant->gender) == 'female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                                <option value="other" {{ old('gender', $participant->gender) == 'other' ? 'selected' : '' }}>{{ __('messages.other') }}</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="birth_date" class="block text-sm font-medium text-gray-700">{{ __('messages.birth_date') }}</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $participant->birth_date) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('birth_date') border-red-300 @enderror" required>
                            @error('birth_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="nationality" class="block text-sm font-medium text-gray-700">{{ __('messages.nationality') }}</label>
                            <input type="text" name="nationality" id="nationality" value="{{ old('nationality', $participant->nationality) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('nationality') border-red-300 @enderror" 
                                   placeholder="{{ __('messages.enter_nationality') }}" required>
                            @error('nationality')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="religion" class="block text-sm font-medium text-gray-700">{{ __('messages.religion') }}</label>
                            <input type="text" name="religion" id="religion" value="{{ old('religion', $participant->religion) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('religion') border-red-300 @enderror" 
                                   placeholder="{{ __('messages.enter_religion') }}" required>
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
                                <input type="number" name="height" id="height" value="{{ old('height', $participant->height) }}"
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
                                <input type="number" name="weight" id="weight" value="{{ old('weight', $participant->weight) }}"
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
                            <label for="marital_status" class="block text-sm font-medium text-gray-700">{{ __('messages.marital_status') }}</label>
                            <select name="marital_status" id="marital_status" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" required>
                                <option value="">{{ __('messages.select_status') }}</option>
                                <option value="single" {{ old('marital_status', $participant->marital_status) == 'single' ? 'selected' : '' }}>{{ __('messages.single') }}</option>
                                <option value="married" {{ old('marital_status', $participant->marital_status) == 'married' ? 'selected' : '' }}>{{ __('messages.married') }}</option>
                                <option value="divorced" {{ old('marital_status', $participant->marital_status) == 'divorced' ? 'selected' : '' }}>{{ __('messages.divorced') }}</option>
                                <option value="widowed" {{ old('marital_status', $participant->marital_status) == 'widowed' ? 'selected' : '' }}>{{ __('messages.widowed') }}</option>
                            </select>
                        </div>
                        
                        <div class="space-y-1">
                            <label for="education" class="block text-sm font-medium text-gray-700">{{ __('messages.education') }}</label>
                            <input type="text" name="education" id="education" value="{{ old('education', $participant->education) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="{{ __('messages.enter_education') }}" required>
                        </div>
                        
                        <div class="space-y-1">
                            <label for="no_of_children" class="block text-sm font-medium text-gray-700">{{ __('messages.number_of_children') }}</label>
                            <input type="text" name="no_of_children" id="no_of_children" value="{{ old('no_of_children', $participant->no_of_children) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="BOY 9 Y.O">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('messages.current_status') }}</label>
                            <input type="text" name="status" id="status" value="{{ old('status', $participant->status) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="{{ __('messages.enter_status') }}" required>
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
                            <input type="number" name="hongkong_year" id="hongkong_year" value="{{ old('hongkong_year', $participant->hongkong_year) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="singapore_year" class="block text-sm font-medium text-gray-700">{{ __('messages.singapore') }}</label>
                            <input type="number" name="singapore_year" id="singapore_year" value="{{ old('singapore_year', $participant->singapore_year) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="taiwan_year" class="block text-sm font-medium text-gray-700">{{ __('messages.taiwan') }}</label>
                            <input type="number" name="taiwan_year" id="taiwan_year" value="{{ old('taiwan_year', $participant->taiwan_year) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="malaysia_year" class="block text-sm font-medium text-gray-700">{{ __('messages.malaysia') }}</label>
                            <input type="number" name="malaysia_year" id="malaysia_year" value="{{ old('malaysia_year', $participant->malaysia_year) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white" 
                                   placeholder="0" min="0">
                        </div>
                        
                        <div class="space-y-1">
                            <label for="brunei_year" class="block text-sm font-medium text-gray-700">{{ __('messages.brunei') }}</label>
                            <input type="number" name="brunei_year" id="brunei_year" value="{{ old('brunei_year', $participant->brunei_year) }}"
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
                                <option value="learning" {{ old('cantonese', $participant->cantonese) == 'learning' ? 'selected' : '' }}>{{ __('messages.learning') }}</option>
                                <option value="basic" {{ old('cantonese', $participant->cantonese) == 'basic' ? 'selected' : '' }}>{{ __('messages.basic') }}</option>
                                <option value="good" {{ old('cantonese', $participant->cantonese) == 'good' ? 'selected' : '' }}>{{ __('messages.good') }}</option>
                            </select>
                        </div>
                        
                        <div class="space-y-1">
                            <label for="mandarine" class="block text-sm font-medium text-gray-700">Mandarin</label>
                            <select name="mandarine" id="mandarine" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white">
                                <option value="">{{ __('messages.no_knowledge') }} / {{ __('messages.select_level') }}</option>
                                <option value="learning" {{ old('mandarine', $participant->mandarine) == 'learning' ? 'selected' : '' }}>{{ __('messages.learning') }}</option>
                                <option value="basic" {{ old('mandarine', $participant->mandarine) == 'basic' ? 'selected' : '' }}>{{ __('messages.basic') }}</option>
                                <option value="good" {{ old('mandarine', $participant->mandarine) == 'good' ? 'selected' : '' }}>{{ __('messages.good') }}</option>
                            </select>
                        </div>
                        
                        <div class="space-y-1">
                            <label for="english" class="block text-sm font-medium text-gray-700">{{ __('messages.english') }}</label>
                            <select name="english" id="english" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white">
                                <option value="">{{ __('messages.no_knowledge') }} / {{ __('messages.select_level') }}</option>
                                <option value="learning" {{ old('english', $participant->english) == 'learning' ? 'selected' : '' }}>{{ __('messages.learning') }}</option>
                                <option value="basic" {{ old('english', $participant->english) == 'basic' ? 'selected' : '' }}>{{ __('messages.basic') }}</option>
                                <option value="good" {{ old('english', $participant->english) == 'good' ? 'selected' : '' }}>{{ __('messages.good') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Photo Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 pb-3 border-b border-gray-100">{{ __('messages.participant_photo') }}</h2>
                    
                    <!-- Current Photo -->
                    @if($participant->photo_path)
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">{{ __('messages.current_photo') }}:</p>
                            <div class="w-32 h-40 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $participant->photo_path) }}" 
                                     alt="{{ $participant->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif
                    
                    <div class="space-y-1">
                        <label for="photo_path" class="block text-sm font-medium text-gray-700">
                            {{ $participant->photo_path ? __('messages.update_photo') : __('messages.upload_photo') }}
                        </label>
                        <input type="file" name="photo_path" id="photo_path" accept="image/*"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 bg-white @error('photo_path') border-red-300 @enderror">
                        <p class="text-xs text-gray-500">{{ __('messages.photo_upload_note') }}</p>
                        @error('photo_path')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
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
                        @if($participant->workHistories && $participant->workHistories->count() > 0)
                            @foreach($participant->workHistories as $index => $workHistory)
                                <div class="work-history-entry border border-gray-200 rounded-lg p-4 mb-4">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-base font-medium text-gray-800">{{ __('messages.work_history_number', ['number' => $index + 1]) }}</h3>
                                        <button type="button" class="remove-work-history text-red-500 hover:text-red-700 transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="space-y-1">
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.country') }}</label>
                                            <input type="text" name="work_history[{{ $index }}][country]" value="{{ old('work_history.' . $index . '.country', $workHistory->country) }}"
                                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                                   placeholder="{{ __('messages.enter_country') }}">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.period') }}</label>
                                            <input type="text" name="work_history[{{ $index }}][period]" value="{{ old('work_history.' . $index . '.period', $workHistory->period) }}"
                                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                                   placeholder="e.g., 2019-2021">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.target_employer') }}</label>
                                            <input type="text" name="work_history[{{ $index }}][target]" value="{{ old('work_history.' . $index . '.target', $workHistory->target) }}"
                                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                                   placeholder="{{ __('messages.enter_employer') }}">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.reason_for_leaving') }}</label>
                                            <input type="text" name="work_history[{{ $index }}][reason_for_leaving]" value="{{ old('work_history.' . $index . '.reason_for_leaving', $workHistory->reason_for_leaving) }}"
                                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                                   placeholder="{{ __('messages.enter_reason') }}">
                                        </div>
                                        <div class="space-y-1 md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.remarks') }}</label>
                                            <textarea name="work_history[{{ $index }}][remake]" rows="2"
                                                      class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 resize-none" 
                                                      placeholder="{{ __('messages.additional_remarks') }}">{{ old('work_history.' . $index . '.remake', $workHistory->remake) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Initial work history entry if no existing work histories -->
                            <div class="work-history-entry border border-gray-200 rounded-lg p-4 mb-4">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-base font-medium text-gray-800">{{ __('messages.work_history_number', ['number' => 1]) }}</h3>
                                    <button type="button" class="remove-work-history text-red-500 hover:text-red-700 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.country') }}</label>
                                        <input type="text" name="work_history[0][country]" value="{{ old('work_history.0.country') }}"
                                               class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                               placeholder="{{ __('messages.enter_country') }}">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.period') }}</label>
                                        <input type="text" name="work_history[0][period]" value="{{ old('work_history.0.period') }}"
                                               class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                               placeholder="e.g., 2019-2021">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.target_employer') }}</label>
                                        <input type="text" name="work_history[0][target]" value="{{ old('work_history.0.target') }}"
                                               class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                               placeholder="{{ __('messages.enter_employer') }}">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.reason_for_leaving') }}</label>
                                        <input type="text" name="work_history[0][reason_for_leaving]" value="{{ old('work_history.0.reason_for_leaving') }}"
                                               class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                               placeholder="{{ __('messages.enter_reason') }}">
                                    </div>
                                    <div class="space-y-1 md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">{{ __('messages.remarks') }}</label>
                                        <textarea name="work_history[0][remake]" rows="2"
                                                  class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 resize-none" 
                                                  placeholder="{{ __('messages.additional_remarks') }}">{{ old('work_history.0.remake') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <a href="{{ route('participants.index') }}" 
                           class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-200 font-medium text-center">
                            {{ __('messages.cancel') }}
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-200 transform hover:scale-105 shadow-lg font-medium">
                            {{ __('messages.update_participant') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Work History Management
        let workHistoryCount = {{ $participant->workHistories ? $participant->workHistories->count() : 1 }};

        document.getElementById('add-work-history').addEventListener('click', function() {
            const container = document.getElementById('work-history-container');
            const newEntry = createWorkHistoryEntry(workHistoryCount);
            container.insertAdjacentHTML('beforeend', newEntry);
            workHistoryCount++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-work-history')) {
                const entry = e.target.closest('.work-history-entry');
                if (document.querySelectorAll('.work-history-entry').length > 1) {
                    entry.remove();
                    updateWorkHistoryNumbers();
                } else {
                    alert('{{ __('messages.work_history_required') }}');
                }
            }
        });

        function createWorkHistoryEntry(index) {
            return `
                <div class="work-history-entry border border-gray-200 rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-medium text-gray-800">{{ __('messages.work_history') }} #${index + 1}</h3>
                        <button type="button" class="remove-work-history text-red-500 hover:text-red-700 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.country') }}</label>
                            <input type="text" name="work_history[${index}][country]"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                   placeholder="{{ __('messages.enter_country') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.period') }}</label>
                            <input type="text" name="work_history[${index}][period]"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                   placeholder="e.g., 2019-2021">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.target_employer') }}</label>
                            <input type="text" name="work_history[${index}][target]"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                   placeholder="{{ __('messages.enter_employer') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.reason_for_leaving') }}</label>
                            <input type="text" name="work_history[${index}][reason_for_leaving]"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" 
                                   placeholder="{{ __('messages.enter_reason') }}">
                        </div>
                        <div class="space-y-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">{{ __('messages.remarks') }}</label>
                            <textarea name="work_history[${index}][remake]" rows="2"
                                      class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200 resize-none" 
                                      placeholder="{{ __('messages.additional_remarks') }}"></textarea>
                        </div>
                    </div>
                </div>
            `;
        }

        function updateWorkHistoryNumbers() {
            const entries = document.querySelectorAll('.work-history-entry');
            entries.forEach((entry, index) => {
                const title = entry.querySelector('h3');
                title.textContent = `{{ __('messages.work_history') }} #${index + 1}`;
                
                // Update input names to maintain proper indexing
                const inputs = entry.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name && name.includes('work_history[')) {
                        const newName = name.replace(/work_history\[\d+\]/, `work_history[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
        }
    </script>
@endsection
