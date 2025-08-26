@extends('app')

@section('content')
    <style>
        .print-content * {
            font-style: italic !important;
        }
        .content-area * {
            font-style: italic !important;
        }
        
        /* Override border styling to match PDF - thicker borders */
        .print-content table,
        .print-content th,
        .print-content td {
            border: 2px solid #000 !important;
            border-color: #000 !important;
        }
        
        .print-content table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
        }
        
        /* Remove rounded corners and shadows to match PDF */
        .print-content .rounded-lg {
            border-radius: 0 !important;
        }
        
        .print-content .shadow-sm {
            box-shadow: none !important;
        }
        
        /* Override all Tailwind border classes */
        .print-content .border {
            border: 2px solid #000 !important;
        }
        
        .print-content .border-gray-200,
        .print-content .border-gray-300 {
            border-color: #000 !important;
        }
        
        /* Consistent column widths for alignment */
        .col-25 { width: 25% !important; }
        .col-16-67 { width: 16.67% !important; }
        .col-33-33 { width: 33.33% !important; }
        .col-50 { width: 50% !important; }
        .col-40 { width: 40% !important; }
        .col-10 { width: 10% !important; }
        .col-15 { width: 15% !important; }
        
        /* Make all red and blue background cells uppercase */
        .print-content .bg-red-100,
        .print-content .bg-blue-100 {
            text-transform: uppercase !important;
        }
    </style>
    <div class="min-h-screen bg-gray-50 py-8 px-4 content-area">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0">
                    <div>
                        <h1 class="text-3xl font-light text-gray-900 mb-2 italic">{{ __('messages.participant_details') }}</h1>
                        <p class="text-gray-500 text-sm italic">{{ __('messages.complete_info_for', ['name' => $participant->name]) }}</p>
                        <p style="font-style: italic;font-weight: bold;">
                            {{ $participant->code }}
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('participants.index') }}" 
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-200 text-center">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span class="italic">{{ __('messages.back') }}</span>
                            </span>
                        </a>
                        @auth
                            <a href="{{ route('participants.edit', $participant) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 text-center">
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span class="italic">{{ __('messages.edit') }}</span>
                                </span>
                            </a>
                        @else
                            <div class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed text-center" title="{{ __('messages.login_required') ?? 'Login required' }}">
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span class="italic">{{ __('messages.edit') }}</span>
                                </span>
                            </div>
                        @endauth
                        <a href="{{ route('participants.pdf', $participant) }}" 
                           class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 transition-all duration-200 text-center">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="italic">{{ __('messages.download_pdf') ?? 'Download PDF' }}</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Print Content Area -->
            <div class="print-content">
                
                <table class="w-full bg-gray-50 border-2 font-bold border-black mb-8">
                <thead>
                    <tr>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 uppercase font-bold col-25" style="font-style: normal !important;" colspan="4">{{ __('messages.personal_information') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.name') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->name }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.birth_date') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->birth_date }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.gender') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->gender }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.age') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ \Carbon\Carbon::parse($participant->birth_date)->age }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.nationality') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->nationality }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.height') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic col-25">{{ $participant->height }} cm</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.religion') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->religion }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.weight') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic col-25">{{ $participant->weight }} kg</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.marital_status') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->marital_status }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.education') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->education }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.number_of_children') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->no_of_children }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.status') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic uppercase col-25">{{ $participant->status }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="w-full mb-8 bg-gray-50 border-2 font-bold border-black">
                <thead>
                    <tr>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 uppercase font-bold col-33-33" style="font-style: normal !important;" colspan="2">{{ __('messages.work_experience') }}</th>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 uppercase font-bold col-33-33" style="font-style: normal !important;" colspan="4">{{ __('messages.language_skills') }}</th>
                    </tr>
                    <tr>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 italic font-bold col-16-67">Country</th>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 italic font-bold col-16-67">Years</th>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 italic font-bold col-16-67">Language</th>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 italic font-bold col-16-67">Learning</th>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 italic font-bold col-16-67">Basic</th>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 italic font-bold col-16-67">Good</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $workExperiences = $participant->workExperiences->pluck('years', 'country')->toArray();
                        $languages = [
                            ['name' => 'cantonese', 'label' => __('messages.cantonese')],
                            ['name' => 'mandarine', 'label' => __('messages.mandarine')],
                            ['name' => 'english', 'label' => __('messages.english')]
                        ];
                        
                        // Function to normalize country names
                        function normalizeCountryName($country) {
                            $normalized = strtolower(trim($country));
                            $normalized = str_replace(' ', '', $normalized);
                            return $normalized;
                        }
                        
                        // Default countries
                        $defaultCountries = ['Hongkong', 'Singapore', 'Malaysia', 'Taiwan', 'Brunei'];
                        $displayExperiences = [];
                        
                        // Add default countries first, check for both exact match and normalized match
                        foreach($defaultCountries as $country) {
                            $found = false;
                            $years = '-';
                            
                            // First check exact match
                            if (isset($workExperiences[$country])) {
                                $years = $workExperiences[$country];
                                $found = true;
                            } else {
                                // Check for normalized match (e.g., "Hong Kong" matches "Hongkong")
                                $normalizedDefault = normalizeCountryName($country);
                                foreach($workExperiences as $dbCountry => $dbYears) {
                                    if (normalizeCountryName($dbCountry) === $normalizedDefault) {
                                        $years = $dbYears;
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            
                            $displayExperiences[$country] = $years;
                        }
                        
                        // Add any additional countries that are not in defaults, avoiding duplicates
                        foreach($workExperiences as $country => $years) {
                            $isDefault = false;
                            $normalizedCountry = normalizeCountryName($country);
                            
                            // Check if this country matches any default country (normalized)
                            foreach($defaultCountries as $defaultCountry) {
                                if ($normalizedCountry === normalizeCountryName($defaultCountry)) {
                                    $isDefault = true;
                                    break;
                                }
                            }
                            
                            // If not a default country and not already added, add it
                            if (!$isDefault && !array_key_exists($country, $displayExperiences)) {
                                $displayExperiences[$country] = $years;
                            }
                        }
                        
                        $experienceIndex = 0;
                    @endphp
                    
                    @foreach($displayExperiences as $country => $years)
                        <tr>
                            <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">{{ $country }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $years === '-' ? '-' : (empty($years) ? '-' : $years) }}</td>
                            @if($experienceIndex < count($languages))
                                @php $language = $languages[$experienceIndex]; @endphp
                                <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">{{ $language['label'] }}</td>
                                <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'learning' ? '✓' : "" }}</td>
                                <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'basic' ? '✓' : "" }}</td>
                                <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'good' ? '✓' : "" }}</td>
                            @else
                                <td class="p-2 border-2 font-bold border-black bg-red-100 italic col-16-67">&nbsp;</td>
                                <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">&nbsp;</td>
                                <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">&nbsp;</td>
                                <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">&nbsp;</td>
                            @endif
                        </tr>
                        @php $experienceIndex++; @endphp
                    @endforeach
                    
                    @if(count($displayExperiences) == 0)
                        @foreach($defaultCountries as $index => $country)
                            <tr>
                                <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">{{ $country }}</td>
                                <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">-</td>
                                @if($index < count($languages))
                                    @php $language = $languages[$index]; @endphp
                                    <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">{{ $language['label'] }}</td>
                                    <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'learning' ? '✓' : "" }}</td>
                                    <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'basic' ? '✓' : "" }}</td>
                                    <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'good' ? '✓' : "" }}</td>
                                @else
                                    <td class="p-2 border-2 font-bold border-black bg-red-100 italic col-16-67">&nbsp;</td>
                                    <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">&nbsp;</td>
                                    <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">&nbsp;</td>
                                    <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">&nbsp;</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    
                    @while($experienceIndex < 3)
                        @php $language = $languages[$experienceIndex]; @endphp
                        <tr>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-16-67" colspan="2">&nbsp;</td>
                            <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-16-67">{{ $language['label'] }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'learning' ? '✓' : "" }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'basic' ? '✓' : "" }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-16-67">{{ $participant->{$language['name']} == 'good' ? '✓' : "" }}</td>
                        </tr>
                        @php $experienceIndex++; @endphp
                    @endwhile
                        <!-- <td class="p-2 border text-center italic" style="width: 8.3%;">{{ $participant->english == 'good' ? '✓' : "" }}</td> -->
                    </tr>
                </tbody>
            </table>

            @for($i = 0; $i < 3; $i++)
                @php
                    $workHistory = $participant->workHistories->get($i);
                @endphp
                <table class="w-full mb-8 bg-gray-50 border-2 font-bold border-black work-history-table">
                    <thead>
                        <tr>
                            <th class="p-2 border-2 font-bold border-black bg-red-100 uppercase font-bold col-25" style="font-style: normal !important;" colspan="4">{{ __('messages.work_history') }} {{ $i + 1 }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border-2 font-bold border-black text-center italic bg-red-100 uppercase col-25">{{ __('messages.country') }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-25">{{ $workHistory->country ?? '-' }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic bg-red-100 uppercase col-25">{{ __('messages.target_employer') }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-25">{{ $workHistory->target ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 border-2 font-bold border-black text-center italic bg-red-100 uppercase col-25">{{ __('messages.period') }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-25">{{ $workHistory->period ?? '-' }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic bg-red-100 uppercase col-25">{{ __('messages.reason_for_leaving') }}</td>
                            <td class="p-2 border-2 font-bold border-black text-center italic col-25">{{ $workHistory->reason_for_leaving ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 border-2 font-bold border-black text-center italic bg-red-100 uppercase col-25">{{ __('messages.remarks') }}</td>
                            <td class="p-2 border-2 font-bold border-black text-left italic col-25" colspan="3">{{ $workHistory->remake ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            @endfor
            <table class="w-full mb-8 bg-gray-50 border-2 font-bold border-black experience-table">
                <thead>
                    <tr>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 uppercase font-bold col-40" style="font-style: normal !important;" colspan="2">{{ __('messages.experience') }}</th>
                        <th class="p-2 border-2 font-bold border-black bg-red-100 uppercase font-bold col-40" style="font-style: normal !important;" colspan="2">{{ __('messages.participant_photo') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black bg-red-100 italic uppercase col-40">ELDERLY HEALTHY CARE EXPERIENCE</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic col-10">{{ $participant->elderly_healthy_care_experience ? "✓" : "-" }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center align-top photo-container col-50" rowspan="24" colspan="2">
                            @if($participant->photo_path)
                                <div class="w-full h-auto cursor-pointer photo-preview"
                                     data-image="{{ asset('storage/' . $participant->photo_path) }}"
                                     data-name="{{ $participant->name }}">
                                    <img src="{{ asset('storage/' . $participant->photo_path) }}"
                                         alt="{{ $participant->name }}"
                                         class="w-full h-auto object-cover border-none block m-0">
                                </div>
                                <div class="mt-1 text-xs text-gray-500 px-1">{{ $participant->name }}</div>
                                <p class="text-xs text-gray-500">{{ __('messages.click_to_enlarge') }}</p>
                            @else
                                <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                                    <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-500">{{ __('messages.no_photo') }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black bg-red-100 italic uppercase">ELDERLY SICK CARE EXPERIENCE</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic">{{ $participant->elderly_sick_care_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black bg-red-100 italic uppercase">NEWBORN CARE EXPERIENCE</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic">{{ $participant->newborn_care_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black bg-red-100 italic uppercase">CHILDREN CARE EXPERIENCE</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic">{{ $participant->children_care_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black bg-red-100 italic uppercase">I CAN TAKE CARE OF DOG</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic">{{ $participant->i_can_take_care_of_dog ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black bg-red-100 italic uppercase">I CAN TAKE CARE OF CAT</td>
                        <td class="p-2 border-2 font-bold border-black text-center italic">{{ $participant->i_can_take_care_of_cat ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">COOKING’ CLEANING’ WASHING’IRONING GO TO MARKET</td>
                        <td class="p-2 border text-center italic">{{ $participant->cooking_cleaning_washing_ironing_go_to_market ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">I CAN WASH CAR</td>
                        <td class="p-2 border text-center italic">{{ $participant->i_can_wash_car ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">SHUTTLE SCHOOL</td>
                        <td class="p-2 border text-center italic">{{ $participant->shuttle_school ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">ASSIST TOILETING’ CHANGE DIAPER’ BATH EXPERIENCE</td>
                        <td class="p-2 border text-center italic">{{ $participant->assist_toileting_change_diaper_bath_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">GO TO HOSPITAL’ HANDLE MEDICATION EXPERIENCE</td>
                        <td class="p-2 border text-center italic">{{ $participant->go_to_hospital_handle_medication_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">DO EXERCISE</td>
                        <td class="p-2 border text-center italic">{{ $participant->do_exercise ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">USE WHEELCHAIR</td>
                        <td class="p-2 border text-center italic">{{ $participant->use_wheelchair ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">PROVIDE DAILY ASSISTANCE</td>
                        <td class="p-2 border text-center italic">{{ $participant->provide_daily_assistance ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">ORAL FEEDING</td>
                        <td class="p-2 border text-center italic">{{ $participant->oral_feeding ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">WITH DEMENTIA CARE EXPERIENCE</td>
                        <td class="p-2 border text-center italic">{{ $participant->with_dementia_care_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">ASSIST WALKING</td>
                        <td class="p-2 border text-center italic">{{ $participant->assist_walking ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">RECEIVED COVID-19 VACCINE INJECTION (3 DOSE)</td>
                        <td class="p-2 border text-center italic">{{ $participant->received_covid19_vaccine_injection_3_dose ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">I CAN INJECT DIABETES</td>
                        <td class="p-2 border text-center italic">{{ $participant->i_can_inject_diabetes ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">I CAN TAKE CARE OF IDIOTS</td>
                        <td class="p-2 border text-center italic">{{ $participant->i_can_take_care_of_idiots ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">SUCTION PHLEGM I CAN DO IT</td>
                        <td class="p-2 border text-center italic">{{ $participant->suction_phlegm_ican_do_it ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">I LIKE TAKE CARE OF A CHILDREN</td>
                        <td class="p-2 border text-center italic">{{ $participant->i_like_take_care_of_a_children ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">I LIKE TAKE CARE OF A NEWBORN BABY</td>
                        <td class="p-2 border text-center italic">{{ $participant->i_like_take_care_of_a_newborn_baby ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-red-100 italic">I LIKE TAKE CARE OF THE ELDERLY</td>
                        <td class="p-2 border text-center italic">{{ $participant->i_like_take_care_of_the_elderly ? "✓" : "-" }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- New Job Section -->
            <table class="w-full mb-8 bg-gray-50 border-2 font-bold border-black">
                <tbody>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 italic uppercase col-25">{{ __('messages.new_job') }}</td>
                        <td class="p-2 border-2 font-bold border-black text-center col-25" colspan="2" rowspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-left italic col-25" style="vertical-align: top; padding-top: 8px;">
                            {!! $participant->new_job ?? '' !!}
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 uppercase col-25">&nbsp;</td>
                        <td class="p-2 border-2 font-bold border-black text-center bg-blue-100 uppercase col-15">{{ __('messages.date') }}:</td>
                        <td class="p-2 border-2 font-bold border-black text-center col-10">{{ $participant->date ? \Carbon\Carbon::parse($participant->date)->format('d/m/Y') : '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End Print Content Area -->
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
