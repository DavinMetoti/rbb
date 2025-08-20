@extends('app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-3xl font-light text-gray-900">{{ __('messages.participants') }}</h1>
                    <p class="text-gray-500 text-sm mt-1">{{ __('messages.manage_participants') }}</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('participants.index') }}" class="flex-1 sm:flex-none">
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="{{ __('messages.search_placeholder') }}" 
                                       class="w-full px-4 py-3 pr-10 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200">
                                @if(request('search'))
                                    <a href="{{ route('participants.index') }}" 
                                       class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 transition-colors text-lg font-bold">
                                        ✕
                                    </a>
                                @endif
                            </div>
                            <button type="submit" 
                                    class="px-4 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 transition-all duration-200 whitespace-nowrap">
                                {{ __('messages.search') }}
                            </button>
                        </div>
                    </form>
                    
                    @auth
                        <!-- Add Participant Button (only for authenticated users) -->
                        <a href="{{ route('participants.create') }}" 
                           class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-200 transform hover:scale-105 shadow-lg font-medium whitespace-nowrap">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span>{{ __('messages.add_participant') }}</span>
                            </span>
                        </a>
                        
                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 transition-all duration-200 transform hover:scale-105 shadow-lg font-medium whitespace-nowrap">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>{{ __('messages.logout') ?? 'Logout' }}</span>
                                </span>
                            </button>
                        </form>
                    @else
                        <!-- Login Button (only for guest users) -->
                        <a href="{{ route('login') }}" 
                           class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-200 transform hover:scale-105 shadow-lg font-medium whitespace-nowrap">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                <span>{{ __('messages.login') ?? 'Login' }}</span>
                            </span>
                        </a>
                        
                        <!-- Info Message for Guest Users -->
                        <div class="px-4 py-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                {{ __('messages.login_to_manage') ?? 'Login to add, edit, or delete participants' }}
                            </p>
                        </div>
                        
                        <!-- Info about private participants -->
                        <div class="px-4 py-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-sm text-blue-800">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('messages.public_profiles_only') ?? 'Only public participant profiles are shown. Login to view all profiles.' }}
                            </p>
                        </div>
                    @endauth
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

            <!-- Translation Status Notification -->
            <div id="translation-notification" class="hidden mb-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span id="translation-message" class="text-blue-700 font-medium"></span>
                    </div>
                </div>
            </div>

            <!-- Search Results Info -->
            @if(request('search'))
                <div class="mb-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="text-blue-700 font-medium">
                                    {{ __('messages.search_results') }} "{{ request('search') }}" 
                                    - {{ $participants->total() }} {{ __('messages.participants_found') }}
                                </span>
                            </div>
                            <a href="{{ route('participants.index') }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                {{ __('messages.clear_search') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Participants Grid -->
            @if($participants->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach ($participants as $participant)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex space-x-4">
                                <!-- Participant Photo -->
                                <div class="flex-shrink-0">
                                    @if($participant->photo_path)
                                        <div class="w-24 h-32 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center mb-3 cursor-pointer photo-preview" 
                                             data-image="{{ asset('storage/' . $participant->photo_path) }}" 
                                             data-name="{{ $participant->name }}">
                                            <img src="{{ asset('storage/' . $participant->photo_path) }}" 
                                                 alt="{{ $participant->name }}" 
                                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                        </div>
                                    @else
                                        <div class="w-24 h-32 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center mb-3">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Language Skills -->
                                    <div class="w-24">
                                        <p class="text-xs text-gray-500 mb-1">{{ __('messages.languages') }}</p>
                                        <div class="space-y-1">
                                            @if($participant->english)
                                                <div class="px-1 py-1 bg-blue-100 text-blue-800 rounded text-xs text-center">
                                                    {{ __('messages.english') }}: {{ ucfirst($participant->english) }}
                                                </div>
                                            @endif
                                            @if($participant->mandarine)
                                                <div class="px-1 py-1 bg-purple-100 text-purple-800 rounded text-xs text-center">
                                                    {{ __('messages.chinese') }}: {{ ucfirst($participant->mandarine) }}
                                                </div>
                                            @endif
                                            @if($participant->cantonese)
                                                <div class="px-1 py-1 bg-orange-100 text-orange-800 rounded text-xs text-center">
                                                    {{ __('messages.cantonese') }}: {{ ucfirst($participant->cantonese) }}
                                                </div>
                                            @endif
                                            @if(!$participant->english && !$participant->mandarine && !$participant->cantonese)
                                                <div class="px-1 py-1 bg-gray-100 text-gray-500 rounded text-xs text-center">
                                                    {{ __('messages.no_languages') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Participant Info -->
                                <div class="flex-1 min-w-0">
                                    <!-- Name and Code -->
                                    <div class="mb-3 bg-blue-800 p-2 rounded-lg">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-semibold text-white mb-1 truncate">{{ $participant->name }}</h3>
                                                <p class="text-sm text-gray-300 font-mono">{{ $participant->code }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Basic Info -->
                                    <div class="mb-4">
                                        <table class="w-full text-sm text-gray-600">
                                            <tr>
                                                <td class="py-1 w-20 font-semibold">{{ __('messages.nationality') }}</td>
                                                <td class="py-1 font-medium">{{ $participant->nationality }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1 font-semibold">{{ __('messages.age') }}</td>
                                                <td class="py-1 font-medium">{{ abs((int) now()->diffInYears($participant->birth_date)) }} {{ __('messages.years') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1 font-semibold">{{ __('messages.education') }}</td>
                                                <td class="py-1 font-medium">{{ $participant->education }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1 font-semibold">{{ __('messages.marital') }}</td>
                                                <td class="py-1 font-medium">{{ ucfirst($participant->marital_status) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1 font-semibold">{{ __('messages.religion') }}</td>
                                                <td class="py-1 font-medium">{{ ucfirst($participant->religion) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1 font-semibold">{{ __('messages.height') }}</td>
                                                <td class="py-1 font-medium">{{ $participant->height }} cm</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1 font-semibold">{{ __('messages.weight') }}</td>
                                                <td class="py-1 font-medium">{{ $participant->weight }} kg</td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Experience Details -->
                                        <div class="mt-3">
                                            <p class="text-sm text-gray-700 mb-2 font-semibold">{{ __('messages.experience') }}:</p>
                                            <table class="w-full text-sm text-gray-600 border border-gray-200 rounded">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="border border-gray-200 px-2 py-1 text-left font-bold">Country</th>
                                                        <th class="border border-gray-200 px-2 py-1 text-center font-bold">{{ __('messages.years') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        // Create a map of countries to years from work experiences
                                                        $experienceMap = [];
                                                        foreach ($participant->workExperiences as $experience) {
                                                            $experienceMap[strtolower($experience->country)] = $experience->years;
                                                        }
                                                        
                                                        // Define the countries to display
                                                        $countries = [
                                                            'hong_kong' => __('messages.hong_kong'),
                                                            'singapore' => __('messages.singapore'),
                                                            'taiwan' => __('messages.taiwan'),
                                                            'malaysia' => __('messages.malaysia'),
                                                            'brunei' => __('messages.brunei')
                                                        ];
                                                    @endphp
                                                    
                                                    @foreach($countries as $countryKey => $countryName)
                                                        @php
                                                            // Try to find the experience for this country
                                                            $years = '';
                                                            $searchKeys = [
                                                                strtolower($countryName),
                                                                strtolower(str_replace(' ', '', $countryName)),
                                                                strtolower(str_replace('_', ' ', $countryKey)),
                                                                $countryKey
                                                            ];
                                                            
                                                            foreach ($searchKeys as $searchKey) {
                                                                if (isset($experienceMap[$searchKey])) {
                                                                    $years = $experienceMap[$searchKey];
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <td class="border border-gray-200 px-2 py-1 font-medium">{{ $countryName }}</td>
                                                            <td class="border border-gray-200 px-2 py-1 text-center font-semibold">{{ empty($years) ? '-' : $years }}</td>
                                                        </tr>
                                                    @endforeach
                                                    
                                                    @if($participant->workExperiences->count() > 0)
                                                        @foreach($participant->workExperiences as $experience)
                                                            @if(!in_array(strtolower($experience->country), ['hong kong', 'singapore', 'taiwan', 'malaysia', 'brunei']))
                                                                <tr>
                                                                    <td class="border border-gray-200 px-2 py-1 font-medium">{{ $experience->country }}</td>
                                                                    <td class="border border-gray-200 px-2 py-1 text-center font-semibold">{{ $experience->years }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex space-x-2">
                                        <a href="{{ route('participants.show', $participant) }}" 
                                           class="flex-1 text-center px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 text-sm font-medium">
                                            {{ __('messages.view') }}
                                        </a>
                                        @auth
                                            <a href="{{ route('participants.edit', $participant) }}" 
                                               class="flex-1 text-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-sm font-medium">
                                                {{ __('messages.edit') }}
                                            </a>
                                            <form action="{{ route('participants.destroy', $participant) }}" method="POST" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200 text-sm font-medium delete-btn"
                                                        data-name="{{ $participant->name }}"
                                                        data-code="{{ $participant->code }}">
                                                    {{ __('messages.delete') }}
                                                </button>
                                            </form>
                                        @else
                                            <div class="flex-1 text-center px-3 py-2 bg-gray-50 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed" title="{{ __('messages.login_required') ?? 'Login required' }}">
                                                {{ __('messages.edit') }}
                                            </div>
                                            <div class="flex-1 text-center px-3 py-2 bg-gray-50 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed" title="{{ __('messages.login_required') ?? 'Login required' }}">
                                                {{ __('messages.delete') }}
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                            <!-- Pagination Info -->
                            <div class="text-sm text-gray-700">
                                <span class="font-medium">{{ $participants->firstItem() ?? 0 }}</span>
                                {{ __('messages.to') }}
                                <span class="font-medium">{{ $participants->lastItem() ?? 0 }}</span>
                                {{ __('messages.of') }}
                                <span class="font-medium">{{ $participants->total() }}</span>
                                {{ __('messages.participants') }}
                            </div>

                            <!-- Pagination Links -->
                            @if ($participants->hasPages())
                                <nav class="flex items-center space-x-1">
                                    {{-- Previous Page Link --}}
                                    @if ($participants->onFirstPage())
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </span>
                                    @else
                                        <a href="{{ $participants->previousPageUrl() }}" 
                                           class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </a>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($participants->getUrlRange(1, $participants->lastPage()) as $page => $url)
                                        @if ($page == $participants->currentPage())
                                            <span class="px-3 py-2 text-white bg-gray-900 rounded-lg font-medium">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}" 
                                               class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-colors">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($participants->hasMorePages())
                                        <a href="{{ $participants->nextPageUrl() }}" 
                                           class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </span>
                                    @endif
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 max-w-md mx-auto">
                        @if(request('search'))
                            <!-- No Search Results -->
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('messages.no_participants') }}</h3>
                            <p class="text-gray-500 mb-6">No participants match your search for "<strong>{{ request('search') }}</strong>". Try a different search term.</p>
                            <div class="space-x-3">
                                <a href="{{ route('participants.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                    {{ __('messages.clear_search') }}
                                </a>
                                @auth
                                    <a href="{{ route('participants.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        {{ __('messages.add_participant') }}
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('messages.login') ?? 'Login' }}
                                    </a>
                                @endauth
                            </div>
                        @else
                            <!-- No Participants At All -->
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('messages.no_participants') }}</h3>
                            <p class="text-gray-500 mb-6">{{ __('messages.get_started') }}</p>
                            @auth
                                <a href="{{ route('participants.create') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    {{ __('messages.add_participant') }}
                                </a>
                            @else
                                <div class="space-y-4">
                                    <p class="text-sm text-gray-600">{{ __('messages.login_to_add_participants') ?? 'Login to add participants' }}</p>
                                    <a href="{{ route('login') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('messages.login') ?? 'Login' }}
                                    </a>
                                </div>
                            @endauth
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Hidden translation data -->
    <script type="application/json" id="translations-data">
        {!! json_encode(['delete_confirm' => __('messages.delete_confirm')]) !!}
    </script>

    <!-- Image Preview Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl max-h-screen mx-4">
            <button onclick="closeImageModal()" class="absolute -top-10 right-0 text-white text-xl hover:text-gray-300 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-screen object-contain rounded-lg">
            <p id="modalTitle" class="text-white text-center mt-4 text-lg font-medium"></p>
        </div>
    </div>

    <script>
        // Translation functionality using LibreTranslate API
        let currentLanguage = '{{ session("applocale", "en") }}'; // Get current language from session
        let translationCache = new Map(); // Cache translations to avoid repeated API calls
        let isTranslating = false; // Prevent multiple simultaneous translations

        console.log('Initial language from session:', currentLanguage);

        async function translateText(text, targetLang = 'en') {
            if (!text || text.trim() === '') return text;
            
            // Common translation mappings to ensure consistency
            const translationMappings = {
                'en': {
                    // Nationalities
                    'indonesian': 'Indonesian',
                    'indonesia': 'Indonesian', 
                    'malaysia': 'Malaysian',
                    'singapore': 'Singaporean',
                    'philippines': 'Filipino',
                    'thailand': 'Thai',
                    'vietnam': 'Vietnamese',
                    'myanmar': 'Myanmar',
                    'china': 'Chinese',
                    '印度尼西亚人': 'Indonesian',
                    '马来西亚人': 'Malaysian',
                    '新加坡人': 'Singaporean',
                    '菲律宾人': 'Filipino',
                    '泰国人': 'Thai',
                    '越南人': 'Vietnamese',
                    '缅甸人': 'Myanmar',
                    '中国人': 'Chinese',
                    // Education
                    'elementary school': 'Elementary School',
                    'primary school': 'Primary School',
                    'junior high school': 'Junior High School',
                    'middle school': 'Middle School',
                    'senior high school': 'Senior High School',
                    'high school': 'High School',
                    'diploma': 'Diploma',
                    'bachelor': 'Bachelor',
                    'master': 'Master',
                    'phd': 'PhD',
                    '小学': 'Elementary School',
                    '初中': 'Junior High School',
                    '高中': 'Senior High School',
                    '文凭': 'Diploma',
                    '学士': 'Bachelor',
                    '硕士': 'Master',
                    '博士': 'PhD',
                    // Marital Status
                    'single': 'Single',
                    'married': 'Married',
                    'divorced': 'Divorced',
                    'widowed': 'Widowed',
                    '单身': 'Single',
                    '已婚': 'Married',
                    '离婚': 'Divorced',
                    '丧偶': 'Widowed',
                    // Religion
                    'muslim': 'Muslim',
                    'islam': 'Muslim',
                    'christian': 'Christian',
                    'catholic': 'Catholic',
                    'buddhist': 'Buddhist',
                    'hindu': 'Hindu',
                    'other': 'Other',
                    '穆斯林': 'Muslim',
                    '基督教': 'Christian',
                    '天主教': 'Catholic',
                    '佛教': 'Buddhist',
                    '印度教': 'Hindu',
                    '其他': 'Other'
                },
                'zh': {
                    // Nationalities
                    'indonesian': '印度尼西亚人',
                    'indonesia': '印度尼西亚人',
                    'malaysia': '马来西亚人',
                    'singapore': '新加坡人',
                    'philippines': '菲律宾人',
                    'thailand': '泰国人',
                    'vietnam': '越南人',
                    'myanmar': '缅甸人',
                    'china': '中国人',
                    // Education
                    'elementary school': '小学',
                    'primary school': '小学',
                    'junior high school': '初中',
                    'middle school': '初中',
                    'senior high school': '高中',
                    'high school': '高中',
                    'diploma': '文凭',
                    'bachelor': '学士',
                    'master': '硕士',
                    'phd': '博士',
                    // Marital Status
                    'single': '单身',
                    'married': '已婚',
                    'divorced': '离婚',
                    'widowed': '丧偶',
                    // Religion
                    'muslim': '穆斯林',
                    'islam': '穆斯林',
                    'christian': '基督教',
                    'catholic': '天主教',
                    'buddhist': '佛教',
                    'hindu': '印度教',
                    'other': '其他'
                }
            };
            
            // Check if we have a direct mapping first
            const lowerText = text.toLowerCase().trim();
            if (translationMappings[targetLang] && translationMappings[targetLang][lowerText]) {
                console.log(`Using direct mapping: ${text} -> ${translationMappings[targetLang][lowerText]}`);
                return translationMappings[targetLang][lowerText];
            }
            
            // Also check exact match (case sensitive for Chinese)
            if (translationMappings[targetLang] && translationMappings[targetLang][text]) {
                console.log(`Using exact mapping: ${text} -> ${translationMappings[targetLang][text]}`);
                return translationMappings[targetLang][text];
            }
            
            // Create cache key
            const cacheKey = `${text}_${targetLang}`;
            
            // Check cache first
            if (translationCache.has(cacheKey)) {
                return translationCache.get(cacheKey);
            }

            try {
                const response = await fetch("https://libretranslate.com/translate", {
                    method: "POST",
                    body: JSON.stringify({
                        q: text,
                        source: "auto",
                        target: targetLang,
                        format: "text",
                        alternatives: 3,
                        api_key: ""
                    }),
                    headers: { 
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                const translatedText = data.translatedText || text;
                
                // Cache the translation
                translationCache.set(cacheKey, translatedText);
                
                return translatedText;
            } catch (error) {
                console.warn('Translation failed for:', text, error);
                // Fallback to direct mapping if API fails
                if (translationMappings[targetLang] && translationMappings[targetLang][lowerText]) {
                    return translationMappings[targetLang][lowerText];
                }
                if (translationMappings[targetLang] && translationMappings[targetLang][text]) {
                    return translationMappings[targetLang][text];
                }
                return text; // Return original text if translation fails
            }
        }

        async function translateDatabaseValues(targetLang = 'en') {
            console.log('translateDatabaseValues called with:', targetLang, 'isTranslating:', isTranslating);
            
            if (isTranslating) {
                console.log('Translation already in progress, skipping...');
                return;
            }
            
            isTranslating = true;
            console.log(`Starting translation to ${targetLang}`);
            
            try {
                // Look for all table cells that contain participant data
                const allCells = document.querySelectorAll('td, div, span, p');
                console.log(`Found ${allCells.length} elements to check for translation`);
                
                // Define patterns to identify translatable content
                const translatablePatterns = [
                    // Nationality - more comprehensive patterns
                    /^(indonesian?|malaysian?|singaporean?|filipino?|thai|vietnamese?|myanmar|chinese?)$/i,
                    /^(malaysia|singapore|philippines|thailand|vietnam|myanmar|china)$/i,
                    // Chinese nationality patterns
                    /^(印度尼西亚人|马来西亚人|新加坡人|菲律宾人|泰国人|越南人|缅甸人|中国人)$/i,
                    // Education levels
                    /^(elementary|primary|junior\s+high|middle|senior\s+high|high\s+school|diploma|bachelor|master|phd)(\s+school)?$/i,
                    /^(elementary\s+school|primary\s+school|junior\s+high\s+school|senior\s+high\s+school)$/i,
                    // Chinese education patterns
                    /^(小学|初中|高中|文凭|学士|硕士|博士)$/i,
                    // Marital Status
                    /^(single|married|divorced|widowed)$/i,
                    /^(单身|已婚|离婚|丧偶)$/i,
                    // Religion
                    /^(muslim|islam|islamic|christian|catholic|buddhist|hindu|other)$/i,
                    /^(穆斯林|基督教|天主教|佛教|印度教|其他)$/i
                ];

                let translatedCount = 0;
                let checkedCount = 0;

                for (const cell of allCells) {
                    const text = cell.textContent.trim();
                    checkedCount++;
                    
                    // Skip empty cells, numbers, measurements, and very short text
                    if (!text || text.length < 2 || /^\d+(\s*(cm|kg|years?|岁|年|tahun))?$/i.test(text)) {
                        continue;
                    }
                    
                    // Check if this text matches any translatable pattern
                    const shouldTranslate = translatablePatterns.some(pattern => pattern.test(text));
                    
                    if (shouldTranslate) {
                        // Store original text if not already stored
                        const originalText = cell.getAttribute('data-original') || text;
                        if (!cell.getAttribute('data-original')) {
                            cell.setAttribute('data-original', originalText);
                        }
                        
                        console.log(`Found translatable content: "${originalText}" -> translating to ${targetLang}`);
                        
                        try {
                            // Translate and update
                            const translatedText = await translateText(originalText, targetLang);
                            console.log(`Translation result: "${originalText}" -> "${translatedText}"`);
                            
                            if (translatedText !== text) {
                                cell.textContent = translatedText;
                                translatedCount++;
                            }
                            
                            // Add a small delay to avoid overwhelming the API
                            await new Promise(resolve => setTimeout(resolve, 50));
                        } catch (error) {
                            console.warn('Translation failed for:', originalText, error);
                        }
                    }
                }
                
                console.log(`Checked ${checkedCount} elements, translated ${translatedCount} items to ${targetLang}`);
                
            } finally {
                isTranslating = false;
                console.log('Translation process finished, isTranslating set to false');
            }
        }

        // Function to handle language changes from header dropdown
        async function handleLanguageChange(newLang) {
            console.log(`handleLanguageChange called: ${currentLanguage} -> ${newLang}`);
            
            // COMMENTED OUT - Allow translation even if same language to force refresh
            // if (currentLanguage === newLang && !isTranslating) {
            //     console.log('Same language, skipping translation');
            //     return;
            // }
            
            currentLanguage = newLang;
            
            // Show loading indicator and notification
            showLoadingIndicator();
            
            if (newLang === 'zh') {
                showNotification('正在翻译内容到中文...', 'info');
            } else {
                showNotification('Translating content to English...', 'info');
            }
            
            try {
                await translateDatabaseValues(newLang);
                
                if (newLang === 'zh') {
                    showNotification('内容已成功翻译为中文！', 'success');
                } else {
                    showNotification('Content successfully translated to English!', 'success');
                }
                
            } catch (error) {
                console.error('Translation error:', error);
                showNotification('Translation failed. Please try again.', 'error');
            } finally {
                hideLoadingIndicator();
                // Hide notification after 3 seconds
                setTimeout(() => hideNotification(), 3000);
            }
        }

        // Function to force immediate translation
        async function forceTranslate(targetLang) {
            console.log(`Force translating to ${targetLang}`);
            currentLanguage = targetLang;
            isTranslating = false; // Reset flag to ensure translation runs
            console.log('Reset isTranslating flag to false');
            await handleLanguageChange(targetLang);
        }

        // Watch for language changes in the URL or page
        function detectLanguageChange() {
            const urlParams = new URLSearchParams(window.location.search);
            const currentUrlLang = window.location.pathname.includes('/lang/zh') ? 'zh' : 'en';
            
            // Check if language changed
            if (currentUrlLang !== currentLanguage) {
                handleLanguageChange(currentUrlLang);
            }
        }

        function showNotification(message, type = 'info') {
            const notification = document.getElementById('translation-notification');
            
            if (notification) {
                // Update notification styling based on type
                notification.className = 'mb-6';
                if (type === 'success') {
                    notification.innerHTML = `
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-green-700 font-medium">${message}</span>
                            </div>
                        </div>
                    `;
                } else if (type === 'error') {
                    notification.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-red-700 font-medium">${message}</span>
                            </div>
                        </div>
                    `;
                } else {
                    notification.innerHTML = `
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-blue-700 font-medium">${message}</span>
                            </div>
                        </div>
                    `;
                }
                
                notification.classList.remove('hidden');
            }
        }

        function hideNotification() {
            const notification = document.getElementById('translation-notification');
            if (notification) {
                notification.classList.add('hidden');
            }
        }

        function showLoadingIndicator() {
            // Create a floating loading indicator since we removed the header one
            let indicator = document.getElementById('translation-loading');
            if (!indicator) {
                indicator = document.createElement('div');
                indicator.id = 'translation-loading';
                indicator.className = 'fixed top-20 right-4 z-50 bg-white rounded-lg shadow-lg p-3 flex items-center space-x-2';
                indicator.innerHTML = `
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-indigo-600"></div>
                    <span class="text-sm text-gray-700">Translating...</span>
                `;
                document.body.appendChild(indicator);
            } else {
                indicator.classList.remove('hidden');
            }
        }

        function hideLoadingIndicator() {
            const indicator = document.getElementById('translation-loading');
            if (indicator) {
                indicator.classList.add('hidden');
            }
        }

        // Photo preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get translations from JSON script tag
            const translationsElement = document.getElementById('translations-data');
            const translations = JSON.parse(translationsElement.textContent);
            
            const photoElements = document.querySelectorAll('.photo-preview');
            
            photoElements.forEach(element => {
                element.addEventListener('click', function() {
                    const imageSrc = this.getAttribute('data-image');
                    const participantName = this.getAttribute('data-name');
                    openImageModal(imageSrc, participantName);
                });
            });

            // Delete confirmation functionality
            const deleteButtons = document.querySelectorAll('.delete-btn');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const name = this.getAttribute('data-name');
                    const code = this.getAttribute('data-code');
                    
                    // Create the confirmation message with proper replacements
                    const confirmMessage = translations.delete_confirm
                        .replace(':name', name)
                        .replace(':code', code);
                    
                    if (!confirm(confirmMessage)) {
                        e.preventDefault();
                    }
                });
            });

            // Search functionality
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                // Submit on Enter key
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        this.form.submit();
                    }
                });

                // Handle clear button
                const clearButton = document.querySelector('a[href*="participants.index"]');
                if (clearButton && clearButton.textContent.includes('✕')) {
                    clearButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        searchInput.value = '';
                        window.location.href = this.href;
                    });
                }
            }

            // Listen for language dropdown clicks in header - SIMPLIFIED VERSION
            const languageLinks = document.querySelectorAll('a[href*="/lang/"], a[href*="lang/zh"], a[href*="lang/en"]');
            languageLinks.forEach(link => {
                if (!link.hasAttribute('data-translation-listener')) {
                    link.setAttribute('data-translation-listener', 'true');
                    link.addEventListener('click', function(e) {
                        const newLang = this.href.includes('zh') ? 'zh' : 'en';
                        
                        console.log('Language link clicked:', newLang, 'from URL:', this.href);
                        
                        if (newLang === 'zh') {
                            e.preventDefault(); // Prevent immediate page reload
                            
                            // Set language immediately
                            currentLanguage = 'zh';
                            localStorage.setItem('selectedLanguage', 'zh');
                            
                            // Show loading immediately
                            showLoadingIndicator();
                            showNotification('正在切换到中文并翻译内容...', 'info');
                            
                            // Start translation immediately
                            forceTranslate('zh').then(() => {
                                // After translation is complete, navigate to Chinese page
                                setTimeout(() => {
                                    window.location.href = this.href;
                                }, 1500); // Longer delay to show translation
                            }).catch(() => {
                                // Even if translation fails, still navigate
                                window.location.href = this.href;
                            });
                        } else {
                            // For English, allow normal navigation
                            localStorage.setItem('selectedLanguage', 'en');
                            currentLanguage = 'en';
                            
                            // Restore original text for English if we have them
                            const elementsWithOriginal = document.querySelectorAll('[data-original]');
                            elementsWithOriginal.forEach(el => {
                                const original = el.getAttribute('data-original');
                                if (original) {
                                    el.textContent = original;
                                }
                            });
                        }
                    });
                }
            });

            // Check if we need to translate content on page load
            const translateOnLoad = localStorage.getItem('translateOnLoad');
            const skipTranslateOnLoad = localStorage.getItem('skipTranslateOnLoad');
            const selectedLanguage = localStorage.getItem('selectedLanguage');
            
            console.log('Page load check:', {
                currentLanguage,
                translateOnLoad,
                skipTranslateOnLoad,
                selectedLanguage,
                windowPath: window.location.pathname
            });
            
            // Clear localStorage flags after reading
            localStorage.removeItem('skipTranslateOnLoad');
            localStorage.removeItem('translateOnLoad');
            
            // Set current language based on URL path
            if (window.location.pathname.includes('/lang/zh')) {
                currentLanguage = 'zh';
            } else if (window.location.pathname.includes('/lang/en')) {
                currentLanguage = 'en';
            }
            
            console.log('Final current language:', currentLanguage);
            
            // If language is Chinese, translate immediately
            if (currentLanguage === 'zh') {
                console.log('Chinese language detected, starting translation...');
                console.log('About to call forceTranslate with zh');
                setTimeout(() => {
                    console.log('Executing forceTranslate(zh) now...');
                    forceTranslate('zh');
                }, 100);
            }

            // Add manual translation trigger function
            window.translateToLanguage = function(lang) {
                console.log('Manual translation triggered for:', lang);
                forceTranslate(lang);
            };

            // Add global debug function
            window.debugTranslation = function() {
                console.log('Current language:', currentLanguage);
                console.log('URL pathname:', window.location.pathname);
                console.log('Session language from backend:', '{{ session("applocale", "en") }}');
                console.log('Is translating:', isTranslating);
                
                // Find translatable content
                const allCells = document.querySelectorAll('td, div, span, p');
                let translatableContent = [];
                allCells.forEach(cell => {
                    const text = cell.textContent.trim();
                    if (text.match(/^(indonesian?|islam|single|junior high school|married|divorced|muslim)$/i)) {
                        translatableContent.push({
                            text: text,
                            element: cell,
                            original: cell.getAttribute('data-original')
                        });
                    }
                });
                console.log('Found translatable content:', translatableContent);
            };
        });

        function openImageModal(imageSrc, participantName) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            
            modalImage.src = imageSrc;
            modalImage.alt = participantName;
            modalTitle.textContent = participantName;
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
@endsection