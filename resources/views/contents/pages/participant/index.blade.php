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
                                        <h3 class="text-lg font-semibold text-white mb-1 truncate">{{ $participant->name }}</h3>
                                        <p class="text-sm text-gray-300 font-mono">{{ $participant->code }}</p>
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
                                                    <tr>
                                                        <td class="border border-gray-200 px-2 py-1 font-medium">{{ __('messages.hong_kong') }}</td>
                                                        <td class="border border-gray-200 px-2 py-1 text-center font-semibold">{{ $participant->hongkong_year ?? 0 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-200 px-2 py-1 font-medium">{{ __('messages.singapore') }}</td>
                                                        <td class="border border-gray-200 px-2 py-1 text-center font-semibold">{{ $participant->singapore_year ?? 0 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-200 px-2 py-1 font-medium">{{ __('messages.taiwan') }}</td>
                                                        <td class="border border-gray-200 px-2 py-1 text-center font-semibold">{{ $participant->taiwan_year ?? 0 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-200 px-2 py-1 font-medium">{{ __('messages.malaysia') }}</td>
                                                        <td class="border border-gray-200 px-2 py-1 text-center font-semibold">{{ $participant->malaysia_year ?? 0 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border border-gray-200 px-2 py-1 font-medium">{{ __('messages.brunei') }}</td>
                                                        <td class="border border-gray-200 px-2 py-1 text-center font-semibold">{{ $participant->brunei_year ?? 0 }}</td>
                                                    </tr>
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
        // Photo preview functionality
        document.addEventListener('DOMContentLoaded', function() {
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
                    const confirmMessage = `{{ __('delete_confirm', ['name' => ':name', 'code' => ':code']) }}`
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