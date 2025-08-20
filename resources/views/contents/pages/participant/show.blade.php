@extends('app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0">
                    <div>
                        <h1 class="text-3xl font-light text-gray-900 mb-2">{{ __('messages.participant_details') }}</h1>
                        <p class="text-gray-500 text-sm">{{ __('messages.complete_info_for', ['name' => $participant->name]) }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('participants.index') }}" 
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-200 text-center">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>{{ __('messages.back') }}</span>
                            </span>
                        </a>
                        @auth
                            <a href="{{ route('participants.edit', $participant) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 text-center">
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span>{{ __('messages.edit') }}</span>
                                </span>
                            </a>
                        @else
                            <div class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed text-center" title="{{ __('messages.login_required') ?? 'Login required' }}">
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span>{{ __('messages.edit') }}</span>
                                </span>
                            </div>
                        @endauth
                        <a href="{{ route('participants.pdf', $participant) }}" 
                           class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 transition-all duration-200 text-center">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>{{ __('messages.download_pdf') ?? 'Download PDF' }}</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Print Content Area -->
            <div class="print-content">
                
                <table class="w-full bg-gray-50 rounded-lg shadow-sm border border-gray-200">
                <thead>
                    <tr>
                        <th class="p-2 border bg-red-100" colspan="4">{{ __('messages.personal_information') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.name') }}</td>
                        <td class="p-2 border text-center">{{ $participant->name }}</td>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.birth_date') }}</td>
                        <td class="p-2 border text-center">{{ $participant->birth_date }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.gender') }}</td>
                        <td class="p-2 border text-center">{{ $participant->gender }}</td>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.age') }}</td>
                        <td class="p-2 border text-center">{{ \Carbon\Carbon::parse($participant->birth_date)->age }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.nationality') }}</td>
                        <td class="p-2 border text-center">{{ $participant->nationality }}</td>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.height') }}</td>
                        <td class="p-2 border text-center">{{ $participant->height }} cm</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.religion') }}</td>
                        <td class="p-2 border text-center">{{ $participant->religion }}</td>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.weight') }}</td>
                        <td class="p-2 border text-center">{{ $participant->weight }} kg</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.marital_status') }}</td>
                        <td class="p-2 border text-center">{{ $participant->marital_status }}</td>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.education') }}</td>
                        <td class="p-2 border text-center">{{ $participant->education }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.number_of_children') }}</td>
                        <td class="p-2 border text-center">{{ $participant->no_of_children }}</td>
                        <td class="p-2 border text-center bg-blue-100">{{ __('messages.status') }}</td>
                        <td class="p-2 border text-center">{{ $participant->status }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="w-full mb-8 bg-gray-50 rounded-lg shadow-sm border border-gray-200">
                <thead>
                    <tr>
                        <th class="p-2 border bg-red-100" colspan="2" style="width: 50%;">{{ __('messages.work_experience') }}</th>
                        <th class="p-2 border bg-red-100" colspan="4" style="width: 50%;">{{ __('messages.language_skills') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">{{ __('messages.hong_kong') }}</td>
                        <td class="p-2 border text-center" style="width: 25%;">{{ $participant->hongkong_year == 0 || !$participant->hongkong_year ? '-' : $participant->hongkong_year . ' ' . __('messages.years') }}</td>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">&nbsp;</td>
                        <td class="p-2 border text-center bg-blue-100" style="width: 8.3%;">{{ __('messages.learning') }}</td>
                        <td class="p-2 border text-center bg-blue-100" style="width: 8.3%;">{{ __('messages.basic') }}</td>
                        <td class="p-2 border text-center bg-blue-100" style="width: 8.3%;">{{ __('messages.good') }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">{{ __('messages.singapore') }}</td>
                        <td class="p-2 border text-center" style="width: 25%;">{{ $participant->singapore_year == 0 || !$participant->singapore_year ? '-' : $participant->singapore_year . ' ' . __('messages.years') }}</td>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">{{ __('messages.cantonese') }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->cantonese == 'learning' ? '✓' : "" }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->cantonese == 'basic' ? '✓' : "" }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->cantonese == 'good' ? '✓' : "" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">{{ __('messages.taiwan') }}</td>
                        <td class="p-2 border text-center" style="width: 25%;">{{ $participant->taiwan_year == 0 || !$participant->taiwan_year ? '-' : $participant->taiwan_year . ' ' . __('messages.years') }}</td>
                        <td class="p-2 border bg-blue-100 text-center" style="width: 25%;">{{ __('messages.mandarine') }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->mandarine == 'learning' ? '✓' : "" }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->mandarine == 'basic' ? '✓' : "" }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->mandarine == 'good' ? '✓' : "" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">{{ __('messages.malaysia') }}</td>
                        <td class="p-2 border text-center" style="width: 25%;">{{ $participant->malaysia_year == 0 || !$participant->malaysia_year ? '-' : $participant->malaysia_year . ' ' . __('messages.years') }}</td>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">{{ __('messages.english') }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->english == 'learning' ? '✓' : "" }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->english == 'basic' ? '✓' : "" }}</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">{{ $participant->english == 'good' ? '✓' : "" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">{{ __('messages.brunei') }}</td>
                        <td class="p-2 border text-center" style="width: 25%;">{{ $participant->brunei_year == 0 || !$participant->brunei_year ? '-' : $participant->brunei_year . ' ' . __('messages.years') }}</td>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">&nbsp;</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">&nbsp;</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">&nbsp;</td>
                        <td class="p-2 border text-center" style="width: 8.3%;">&nbsp;</td>
                    </tr>
                </tbody>
            </table>

            @for($i = 0; $i < 3; $i++)
                @php
                    $workHistory = $participant->workHistories->get($i);
                @endphp
                <table class="w-full mb-8 bg-gray-50 rounded-lg shadow-sm border border-gray-200 work-history-table">
                    <thead>
                        <tr>
                            <th class="p-2 border bg-red-100" colspan="4">{{ __('messages.work_history') }} {{ $i + 1 }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border text-center bg-blue-100">{{ __('messages.country') }}</td>
                            <td class="p-2 border text-center">{{ $workHistory->country ?? '' }}</td>
                            <td class="p-2 border text-center bg-blue-100">{{ __('messages.target_employer') }}</td>
                            <td class="p-2 border text-center">{{ $workHistory->target ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 border text-center bg-blue-100">{{ __('messages.period') }}</td>
                            <td class="p-2 border text-center">{{ $workHistory->period ?? '' }}</td>
                            <td class="p-2 border text-center bg-blue-100">{{ __('messages.reason_for_leaving') }}</td>
                            <td class="p-2 border text-center">{{ $workHistory->reason_for_leaving ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 border text-center bg-blue-100">{{ __('messages.remarks') }}</td>
                            <td class="p-2 border text-left" colspan="3">{{ $workHistory->remake ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            @endfor
            <table class="w-full mb-8 bg-gray-50 rounded-lg shadow-sm border border-gray-200 experience-table">
                <thead>
                    <tr>
                        <th class="p-2 border bg-red-100" colspan="2">{{ __('messages.experience') }}</th>
                        <th class="p-2 border bg-red-100" colspan="2">{{ __('messages.participant_photo') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border bg-blue-100">ELDERLY HEALTHY CARE EXPERIENCE</td>
                        <td class="p-2 border text-center">{{ $participant->elderly_healthy_care_experience ? "✓" : "-" }}</td>
                        <td class="p-2 border text-center align-top photo-container" rowspan="24" colspan="2">
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
                        <td class="p-2 border bg-blue-100">ELDERLY SICK CARE EXPERIENCE</td>
                        <td class="p-2 border text-center">{{ $participant->elderly_sick_care_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">NEWBORN CARE EXPERIENCE</td>
                        <td class="p-2 border text-center">{{ $participant->newborn_care_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">CHILDREN CARE EXPERIENCE</td>
                        <td class="p-2 border text-center">{{ $participant->children_care_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">I CAN TAKE CARE OF DOG</td>
                        <td class="p-2 border text-center">{{ $participant->i_can_take_care_of_dog ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">I CAN TAKE CARE OF CAT</td>
                        <td class="p-2 border text-center">{{ $participant->i_can_take_care_of_cat ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">COOKING’ CLEANING’ WASHING’IRONING GO TO MARKET</td>
                        <td class="p-2 border text-center">{{ $participant->cooking_cleaning_washing_ironing_go_to_market ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">I CAN WASH CAR</td>
                        <td class="p-2 border text-center">{{ $participant->i_can_wash_car ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">SHUTTLE SCHOOL</td>
                        <td class="p-2 border text-center">{{ $participant->shuttle_school ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">ASSIST TOILETING’ CHANGE DIAPER’ BATH EXPERIENCE</td>
                        <td class="p-2 border text-center">{{ $participant->assist_toileting_change_diaper_bath_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">GO TO HOSPITAL’ HANDLE MEDICATION EXPERIENCE</td>
                        <td class="p-2 border text-center">{{ $participant->go_to_hospital_handle_medication_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">DO EXERCISE</td>
                        <td class="p-2 border text-center">{{ $participant->do_exercise ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">USE WHEELCHAIR</td>
                        <td class="p-2 border text-center">{{ $participant->use_wheelchair ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">PROVIDE DAILY ASSISTANCE</td>
                        <td class="p-2 border text-center">{{ $participant->provide_daily_assistance ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">ORAL FEEDING</td>
                        <td class="p-2 border text-center">{{ $participant->oral_feeding ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">WITH DEMENTIA CARE EXPERIENCE</td>
                        <td class="p-2 border text-center">{{ $participant->with_dementia_care_experience ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">ASSIST WALKING</td>
                        <td class="p-2 border text-center">{{ $participant->assist_walking ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">RECEIVED COVID-19 VACCINE INJECTION (3 DOSE)</td>
                        <td class="p-2 border text-center">{{ $participant->received_covid19_vaccine_injection_3_dose ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">I CAN INJECT DIABETES</td>
                        <td class="p-2 border text-center">{{ $participant->i_can_inject_diabetes ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">I CAN TAKE CARE OF IDIOTS</td>
                        <td class="p-2 border text-center">{{ $participant->i_can_take_care_of_idiots ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">SUCTION PHLEGM I CAN DO IT</td>
                        <td class="p-2 border text-center">{{ $participant->suction_phlegm_ican_do_it ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">I LIKE TAKE CARE OF A CHILDREN</td>
                        <td class="p-2 border text-center">{{ $participant->i_like_take_care_of_a_children ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">I LIKE TAKE CARE OF A NEWBORN BABY</td>
                        <td class="p-2 border text-center">{{ $participant->i_like_take_care_of_a_newborn_baby ? "✓" : "-" }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 border bg-blue-100">I LIKE TAKE CARE OF THE ELDERLY</td>
                        <td class="p-2 border text-center">{{ $participant->i_like_take_care_of_the_elderly ? "✓" : "-" }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- New Job Section -->
            <table class="w-full mb-8 bg-gray-50 rounded-lg shadow-sm border border-gray-200">
                <tbody>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">{{ __('messages.new_job') }}</td>
                        <td class="p-2 border text-center" colspan="2" rowspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-left" style="width: 25%; vertical-align: top; padding-top: 8px;">
                            {{ $participant->new_job ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 border text-center bg-blue-100" style="width: 25%;">&nbsp;</td>
                        <td class="p-2 border text-center bg-blue-100" style="width: 15%;">{{ __('messages.date') }}:</td>
                        <td class="p-2 border text-center" style="width: 10%;">{{ $participant->date ? \Carbon\Carbon::parse($participant->date)->format('d/m/Y') : '' }}</td>
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
