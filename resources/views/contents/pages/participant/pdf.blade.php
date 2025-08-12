<!DOCTYPE html>
<html lang="{{ session('applocale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Participant Details - {{ $participant->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 15px;
            line-height: 1.2;
        }
        
        .header {
            border-bottom: 2px solid #333;
            margin-bottom: 8px;
            padding-bottom: 3px;
        }
        
        .logos {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        
        .logo-left, .logo-right {
            display: table-cell;
            vertical-align: middle;
        }
        
        .logo-left {
            text-align: left;
            width: 100px;
        }
        
        .logo-right {
            text-align: right;
            width: 150px;
        }
        
        .logo-left img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .experience {
            font-size: 7px !important;
        }

        .logo-right img {
            width: 100%;
            height: 80px;
            object-fit: contain;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 8px;
        }
        
        th, td {
            border: 1px solid #000;
            padding: 2px;
            text-align: center;
            font-size: 7px;
            vertical-align: middle;
            line-height: 1.1;
        }
        
        th {
            font-weight: bold;
            font-size: 7px;
        }
        
        .text-left {
            text-align: left;
        }
        
        .bg-red {
            background-color: #fee2e2;
        }
        
        .bg-blue {
            background-color: #dbeafe;
        }
        
        .bg-gray {
            background-color: #f9fafb;
        }
        
        .photo-container {
            text-align: center;
            vertical-align: top;
            padding: 5px;
        }
        
        .photo-container img {
            max-width: 100%;
            max-height: 400px;
            object-fit: contain;
            border: 1px solid #ccc;
        }
        
        .no-photo {
            width: 180px;
            height: 240px;
            background-color: #f3f4f6;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            border: 1px solid #ccc;
            font-size: 10px;
        }
        
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Header with Logos -->
    <div class="header">
        <div class="logos">
            <div class="logo-left">
                @php
                    $rizaldiLogoPath = public_path('assets/images/rizaldi-logo.jpg');
                    $rizaldiLogoExists = file_exists($rizaldiLogoPath);
                @endphp
                @if($rizaldiLogoExists)
                    @php
                        $rizaldiImageData = base64_encode(file_get_contents($rizaldiLogoPath));
                        $rizaldiImageInfo = getimagesize($rizaldiLogoPath);
                        $rizaldiMimeType = $rizaldiImageInfo['mime'] ?? 'image/jpeg';
                    @endphp
                    <img src="data:{{ $rizaldiMimeType }};base64,{{ $rizaldiImageData }}" alt="PT Rizaldi Logo">
                @else
                    <div style="width: 60px; height: 60px; background-color: #f3f4f6; border: 1px solid #ccc; display: inline-flex; align-items: center; justify-content: center; font-size: 8px;">PT Rizaldi</div>
                @endif
            </div>
            <div class="logo-right">
                @php
                    $goldenLogoPath = public_path('assets/images/golder-logo.jpg');
                    $goldenLogoExists = file_exists($goldenLogoPath);
                @endphp
                @if($goldenLogoExists)
                    @php
                        $goldenImageData = base64_encode(file_get_contents($goldenLogoPath));
                        $goldenImageInfo = getimagesize($goldenLogoPath);
                        $goldenMimeType = $goldenImageInfo['mime'] ?? 'image/jpeg';
                    @endphp
                    <img src="data:{{ $goldenMimeType }};base64,{{ $goldenImageData }}" alt="Golden Tiger Logo">
                @else
                    <div style="width: 120px; height: 120px; background-color: #f3f4f6; border: 1px solid #ccc; display: inline-flex; align-items: center; justify-content: center; font-size: 8px;">Golden Tiger</div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Personal Information -->
    <table>
        <thead>
            <tr>
                <th class="bg-red" colspan="4">{{ __('messages.personal_information') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-blue">{{ __('messages.name') }}</td>
                <td>{{ $participant->name }}</td>
                <td class="bg-blue">{{ __('messages.birth_date') }}</td>
                <td>{{ $participant->birth_date }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.gender') }}</td>
                <td>{{ $participant->gender }}</td>
                <td class="bg-blue">{{ __('messages.age') }}</td>
                <td>{{ \Carbon\Carbon::parse($participant->birth_date)->age }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.nationality') }}</td>
                <td>{{ $participant->nationality }}</td>
                <td class="bg-blue">{{ __('messages.height') }}</td>
                <td>{{ $participant->height }} cm</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.religion') }}</td>
                <td>{{ $participant->religion }}</td>
                <td class="bg-blue">{{ __('messages.weight') }}</td>
                <td>{{ $participant->weight }} kg</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.marital_status') }}</td>
                <td>{{ $participant->marital_status }}</td>
                <td class="bg-blue">{{ __('messages.education') }}</td>
                <td>{{ $participant->education }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.number_of_children') }}</td>
                <td>{{ $participant->no_of_children }}</td>
                <td class="bg-blue">{{ __('messages.status') }}</td>
                <td>{{ $participant->status }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Work Experience & Language Skills -->
    <table>
        <thead>
            <tr>
                <th class="bg-red" colspan="2">{{ __('messages.work_experience') }}</th>
                <th class="bg-red" colspan="4">{{ __('messages.language_skills') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-blue">{{ __('messages.hong_kong') }}</td>
                <td>{{ $participant->hongkong_year == 0 || !$participant->hongkong_year ? '-' : $participant->hongkong_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue">&nbsp;</td>
                <td class="bg-blue">{{ __('messages.learning') }}</td>
                <td class="bg-blue">{{ __('messages.basic') }}</td>
                <td class="bg-blue">{{ __('messages.good') }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.singapore') }}</td>
                <td>{{ $participant->singapore_year == 0 || !$participant->singapore_year ? '-' : $participant->singapore_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue">{{ __('messages.cantonese') }}</td>
                <td>{{ $participant->cantonese == 'learning' ? '✓' : "" }}</td>
                <td>{{ $participant->cantonese == 'basic' ? '✓' : "" }}</td>
                <td>{{ $participant->cantonese == 'good' ? '✓' : "" }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.taiwan') }}</td>
                <td>{{ $participant->taiwan_year == 0 || !$participant->taiwan_year ? '-' : $participant->taiwan_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue">{{ __('messages.mandarine') }}</td>
                <td>{{ $participant->mandarine == 'learning' ? '✓' : "" }}</td>
                <td>{{ $participant->mandarine == 'basic' ? '✓' : "" }}</td>
                <td>{{ $participant->mandarine == 'good' ? '✓' : "" }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.malaysia') }}</td>
                <td>{{ $participant->malaysia_year == 0 || !$participant->malaysia_year ? '-' : $participant->malaysia_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue">{{ __('messages.english') }}</td>
                <td>{{ $participant->english == 'learning' ? '✓' : "" }}</td>
                <td>{{ $participant->english == 'basic' ? '✓' : "" }}</td>
                <td>{{ $participant->english == 'good' ? '✓' : "" }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.brunei') }}</td>
                <td>{{ $participant->brunei_year == 0 || !$participant->brunei_year ? '-' : $participant->brunei_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>

    <!-- Work History -->
    @foreach($participant->workHistories as $index => $workHistory)
    <table>
        <thead>
            <tr>
                <th class="bg-red" colspan="4">{{ __('messages.work_history') }} {{ $index + 1 }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-blue">{{ __('messages.country') }}</td>
                <td>{{ $workHistory->country }}</td>
                <td class="bg-blue">{{ __('messages.target_employer') }}</td>
                <td>{{ $workHistory->target }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.period') }}</td>
                <td>{{ $workHistory->period }}</td>
                <td class="bg-blue">{{ __('messages.reason_for_leaving') }}</td>
                <td>{{ $workHistory->reason_for_leaving }}</td>
            </tr>
            <tr>
                <td class="bg-blue">{{ __('messages.remarks') }}</td>
                <td class="text-left" colspan="3">{{ $workHistory->remake }}</td>
            </tr>
        </tbody>
    </table>
    @endforeach

    <!-- Experience & Photo -->
    <table>
        <thead>
            <tr>
                <th class="bg-red" colspan="2">{{ __('messages.experience') }}</th>
                <th class="bg-red" colspan="2">{{ __('messages.participant_photo') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-blue">ELDERLY HEALTHY CARE EXPERIENCE</td>
                <td>{{ $participant->elderly_healthy_care_experience ? "✓" : "-" }}</td>
                <td class="photo-container" rowspan="24" colspan="2">
                    @if($participant->photo_path)
                        @php
                            // Try multiple paths for the image
                            $possiblePaths = [
                                storage_path('app/public/' . $participant->photo_path),
                                public_path('storage/' . $participant->photo_path),
                                base_path('storage/app/public/' . $participant->photo_path)
                            ];
                            
                            $imagePath = null;
                            $imageExists = false;
                            
                            foreach ($possiblePaths as $path) {
                                if (file_exists($path) && is_readable($path)) {
                                    $imagePath = $path;
                                    $imageExists = true;
                                    break;
                                }
                            }
                            
                            Log::info('PDF Image Debug', [
                                'photo_path' => $participant->photo_path,
                                'tried_paths' => $possiblePaths,
                                'found_path' => $imagePath,
                                'exists' => $imageExists
                            ]);
                        @endphp
                        @if($imageExists && $imagePath)
                            @php
                                try {
                                    $imageContent = file_get_contents($imagePath);
                                    if ($imageContent !== false) {
                                        $imageData = base64_encode($imageContent);
                                        $imageInfo = getimagesize($imagePath);
                                        $mimeType = $imageInfo['mime'] ?? 'image/jpeg';
                                    } else {
                                        $imageData = null;
                                    }
                                } catch (Exception $e) {
                                    Log::error('Image processing error: ' . $e->getMessage());
                                    $imageData = null;
                                    $mimeType = 'image/jpeg';
                                }
                            @endphp
                            @if(isset($imageData) && $imageData)
                                <div style="text-align: center; padding: 8px;">
                                    <img src="data:{{ $mimeType }};base64,{{ $imageData }}" 
                                         alt="{{ $participant->name }}" 
                                         style="max-width: 100%; max-height: 400px; object-fit: contain; border: 1px solid #ddd; display: block; margin: 0 auto;">
                                    <div style="margin-top: 5px; font-size: 8px; color: #666;">{{ $participant->name }}</div>
                                </div>
                            @else
                                <div class="no-photo">
                                    <div style="text-align: center; color: #666; font-size: 10px;">
                                        Image processing failed
                                        <br>Path: {{ basename($participant->photo_path) }}
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="no-photo">
                                <div style="text-align: center; color: #666; font-size: 10px;">
                                    Photo file not accessible
                                    <br>{{ basename($participant->photo_path ?? 'N/A') }}
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="no-photo">
                            <div style="text-align: center; color: #666; font-size: 11px; padding: 20px;">
                                No Photo Available
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="bg-blue experience">ELDERLY SICK CARE EXPERIENCE</td>
                <td>{{ $participant->elderly_sick_care_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">NEWBORN CARE EXPERIENCE</td>
                <td>{{ $participant->newborn_care_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">CHILDREN CARE EXPERIENCE</td>
                <td>{{ $participant->children_care_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">I CAN TAKE CARE OF DOG</td>
                <td>{{ $participant->i_can_take_care_of_dog ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">I CAN TAKE CARE OF CAT</td>
                <td>{{ $participant->i_can_take_care_of_cat ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">COOKING' CLEANING' WASHING'IRONING GO TO MARKET</td>
                <td>{{ $participant->cooking_cleaning_washing_ironing_go_to_market ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">I CAN WASH CAR</td>
                <td>{{ $participant->i_can_wash_car ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">SHUTTLE SCHOOL</td>
                <td>{{ $participant->shuttle_school ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">ASSIST TOILETING' CHANGE DIAPER' BATH EXPERIENCE</td>
                <td>{{ $participant->assist_toileting_change_diaper_bath_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">GO TO HOSPITAL' HANDLE MEDICATION EXPERIENCE</td>
                <td>{{ $participant->go_to_hospital_handle_medication_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">DO EXERCISE</td>
                <td>{{ $participant->do_exercise ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">USE WHEELCHAIR</td>
                <td>{{ $participant->use_wheelchair ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">PROVIDE DAILY ASSISTANCE</td>
                <td>{{ $participant->provide_daily_assistance ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">ORAL FEEDING</td>
                <td>{{ $participant->oral_feeding ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">WITH DEMENTIA CARE EXPERIENCE</td>
                <td>{{ $participant->with_dementia_care_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">ASSIST WALKING</td>
                <td>{{ $participant->assist_walking ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">RECEIVED COVID-19 VACCINE INJECTION (3 DOSE)</td>
                <td>{{ $participant->received_covid19_vaccine_injection_3_dose ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">I CAN INJECT DIABETES</td>
                <td>{{ $participant->i_can_inject_diabetes ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">I CAN TAKE CARE OF IDIOTS</td>
                <td>{{ $participant->i_can_take_care_of_idiots ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">SUCTION PHLEGM I CAN DO IT</td>
                <td>{{ $participant->suction_phlegm_ican_do_it ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">I LIKE TAKE CARE OF A CHILDREN</td>
                <td>{{ $participant->i_like_take_care_of_a_children ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">I LIKE TAKE CARE OF A NEWBORN BABY</td>
                <td>{{ $participant->i_like_take_care_of_a_newborn_baby ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience">I LIKE TAKE CARE OF THE ELDERLY</td>
                <td>{{ $participant->i_like_take_care_of_the_elderly ? "✓" : "-" }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
