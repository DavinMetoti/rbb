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
            padding: 1px;
            line-height: 1.2;
            font-style: italic;
        }
        
        .header {
            border-bottom: 2px solid #333;
            margin-bottom: 5px;
            padding-bottom: 1px;
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
        
        .experience-value {
            font-size: 9px !important;
            font-weight: bold;
        }

        .logo-right img {
            width: 100%;
            height: 80px;
            object-fit: contain;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            font-size: 8px;
        }
        
        th, td {
            border: 1px solid #000;
            padding: 1px;
            text-align: center;
            font-size: 7px;
            vertical-align: middle;
            line-height: 1.1;
            height: 15px;
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
            font-style: italic;
        }
        
        .bg-gray {
            background-color: #f9fafb;
        }
        
        .photo-container {
            text-align: center;
            vertical-align: top;
            padding: 0;
            height: auto;
        }
        
        .photo-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border: none;
            display: block;
            margin: 0;
        }
        
        .photo-row {
            height: auto;
        }
        
        .col-25 {
            width: 25%;
        }
        
        .col-20 {
            width: 20%;
        }
        
        .col-15 {
            width: 15%;
        }
        
        .col-10 {
            width: 10%;
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
                <td class="bg-blue col-25">{{ __('messages.name') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->name }}</td>
                <td class="bg-blue col-25">{{ __('messages.birth_date') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->birth_date }}</td>
            </tr>
            <tr>
                <td class="bg-blue col-25">{{ __('messages.gender') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->gender }}</td>
                <td class="bg-blue col-25">{{ __('messages.age') }}</td>
                <td class="col-25" style="font-style: italic;">{{ \Carbon\Carbon::parse($participant->birth_date)->age }}</td>
            </tr>
            <tr>
                <td class="bg-blue col-25">{{ __('messages.nationality') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->nationality }}</td>
                <td class="bg-blue col-25">{{ __('messages.height') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->height }} cm</td>
            </tr>
            <tr>
                <td class="bg-blue col-25">{{ __('messages.religion') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->religion }}</td>
                <td class="bg-blue col-25">{{ __('messages.weight') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->weight }} kg</td>
            </tr>
            <tr>
                <td class="bg-blue col-25">{{ __('messages.marital_status') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->marital_status }}</td>
                <td class="bg-blue col-25">{{ __('messages.education') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->education }}</td>
            </tr>
            <tr>
                <td class="bg-blue col-25">{{ __('messages.number_of_children') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->no_of_children }}</td>
                <td class="bg-blue col-25">{{ __('messages.status') }}</td>
                <td class="col-25" style="font-style: italic;">{{ $participant->status }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Work Experience & Language Skills -->
    <table>
        <thead>
            <tr>
                <th class="bg-red" colspan="2" style="width: 50%;">{{ __('messages.work_experience') }}</th>
                <th class="bg-red" colspan="4" style="width: 50%;">{{ __('messages.language_skills') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bg-blue" style="width: 25%;">{{ __('messages.hong_kong') }}</td>
                <td style="width: 25%;">{{ $participant->hongkong_year == 0 || !$participant->hongkong_year ? '-' : $participant->hongkong_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue" style="width: 25%;">&nbsp;</td>
                <td class="bg-blue" style="width: 8.3%;">{{ __('messages.learning') }}</td>
                <td class="bg-blue" style="width: 8.3%;">{{ __('messages.basic') }}</td>
                <td class="bg-blue" style="width: 8.3%;">{{ __('messages.good') }}</td>
            </tr>
            <tr>
                <td class="bg-blue" style="width: 25%;">{{ __('messages.singapore') }}</td>
                <td style="width: 25%;">{{ $participant->singapore_year == 0 || !$participant->singapore_year ? '-' : $participant->singapore_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue" style="width: 25%;">{{ __('messages.cantonese') }}</td>
                <td style="width: 8.3%;">{{ $participant->cantonese == 'learning' ? '✓' : "" }}</td>
                <td style="width: 8.3%;">{{ $participant->cantonese == 'basic' ? '✓' : "" }}</td>
                <td style="width: 8.3%;">{{ $participant->cantonese == 'good' ? '✓' : "" }}</td>
            </tr>
            <tr>
                <td class="bg-blue" style="width: 25%;">{{ __('messages.taiwan') }}</td>
                <td style="width: 25%;">{{ $participant->taiwan_year == 0 || !$participant->taiwan_year ? '-' : $participant->taiwan_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue" style="width: 25%;">{{ __('messages.mandarine') }}</td>
                <td style="width: 8.3%;">{{ $participant->mandarine == 'learning' ? '✓' : "" }}</td>
                <td style="width: 8.3%;">{{ $participant->mandarine == 'basic' ? '✓' : "" }}</td>
                <td style="width: 8.3%;">{{ $participant->mandarine == 'good' ? '✓' : "" }}</td>
            </tr>
            <tr>
                <td class="bg-blue" style="width: 25%;">{{ __('messages.malaysia') }}</td>
                <td style="width: 25%;">{{ $participant->malaysia_year == 0 || !$participant->malaysia_year ? '-' : $participant->malaysia_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue" style="width: 25%;">{{ __('messages.english') }}</td>
                <td style="width: 8.3%;">{{ $participant->english == 'learning' ? '✓' : "" }}</td>
                <td style="width: 8.3%;">{{ $participant->english == 'basic' ? '✓' : "" }}</td>
                <td style="width: 8.3%;">{{ $participant->english == 'good' ? '✓' : "" }}</td>
            </tr>
            <tr>
                <td class="bg-blue" style="width: 25%;">{{ __('messages.brunei') }}</td>
                <td style="width: 25%;">{{ $participant->brunei_year == 0 || !$participant->brunei_year ? '-' : $participant->brunei_year . ' ' . __('messages.years') }}</td>
                <td class="bg-blue" style="width: 25%;">&nbsp;</td>
                <td style="width: 8.3%;">&nbsp;</td>
                <td style="width: 8.3%;">&nbsp;</td>
                <td style="width: 8.3%;">&nbsp;</td>
            </tr>
        </tbody>
    </table>

    <!-- Work History -->
    @for($i = 0; $i < 3; $i++)
        @php
            $workHistory = $participant->workHistories->get($i);
        @endphp
        <table>
            <thead>
                <tr>
                    <th class="bg-red" colspan="4">{{ __('messages.work_history') }} {{ $i + 1 }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bg-blue col-25">{{ __('messages.country') }}</td>
                    <td class="col-25">{{ $workHistory->country ?? '-' }}</td>
                    <td class="bg-blue col-25">{{ __('messages.target_employer') }}</td>
                    <td class="col-25">{{ $workHistory->target ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-blue col-25">{{ __('messages.period') }}</td>
                    <td class="col-25">{{ $workHistory->period ?? '-' }}</td>
                    <td class="bg-blue col-25">{{ __('messages.reason_for_leaving') }}</td>
                    <td class="col-25">{{ $workHistory->reason_for_leaving ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="bg-blue col-25">{{ __('messages.remarks') }}</td>
                    <td class="text-left" colspan="3">{{ $workHistory->remake ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    @endfor

    <!-- Experience & Photo -->
    <table>
        <thead>
            <tr>
                <th class="bg-red" colspan="2">{{ __('messages.experience') }}</th>
                <th class="bg-red" colspan="2">{{ __('messages.participant_photo') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr class="photo-row">
                <td class="bg-blue" style="width: 40%;font-style: italic;">ELDERLY HEALTHY CARE EXPERIENCE</td>
                <td class="" style="width: 10%;">{{ $participant->elderly_healthy_care_experience ? "✓" : "-" }}</td>
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
                                <img src="data:{{ $mimeType }};base64,{{ $imageData }}" 
                                     alt="{{ $participant->name }}" 
                                     style="width: 100%; height: auto; object-fit: cover; border: none; display: block; margin: 0;">
                                <div style="margin-top: 5px; font-size: 8px; color: #666; padding: 0 5px;">{{ $participant->name }}</div>
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
                            <div style="text-align: center; color: #666; font-size: 11px; padding: 1px;">
                                No Photo Available
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">ELDERLY SICK CARE EXPERIENCE</td>
                <td class="" style="width: 10%;">{{ $participant->elderly_sick_care_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">NEWBORN CARE EXPERIENCE</td>
                <td class="" style="width: 10%;">{{ $participant->newborn_care_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">CHILDREN CARE EXPERIENCE</td>
                <td class="" style="width: 10%;">{{ $participant->children_care_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">I CAN TAKE CARE OF DOG</td>
                <td class="" style="width: 10%;">{{ $participant->i_can_take_care_of_dog ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">I CAN TAKE CARE OF CAT</td>
                <td class="" style="width: 10%;">{{ $participant->i_can_take_care_of_cat ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">COOKING' CLEANING' WASHING'IRONING GO TO MARKET</td>
                <td class="" style="width: 10%;">{{ $participant->cooking_cleaning_washing_ironing_go_to_market ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">I CAN WASH CAR</td>
                <td class="" style="width: 10%;">{{ $participant->i_can_wash_car ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">SHUTTLE SCHOOL</td>
                <td class="" style="width: 10%;">{{ $participant->shuttle_school ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">ASSIST TOILETING' CHANGE DIAPER' BATH EXPERIENCE</td>
                <td class="" style="width: 10%;">{{ $participant->assist_toileting_change_diaper_bath_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">GO TO HOSPITAL' HANDLE MEDICATION EXPERIENCE</td>
                <td class="" style="width: 10%;">{{ $participant->go_to_hospital_handle_medication_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">DO EXERCISE</td>
                <td class="" style="width: 10%;">{{ $participant->do_exercise ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">USE WHEELCHAIR</td>
                <td class="" style="width: 10%;">{{ $participant->use_wheelchair ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">PROVIDE DAILY ASSISTANCE</td>
                <td class="" style="width: 10%;">{{ $participant->provide_daily_assistance ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">ORAL FEEDING</td>
                <td class="" style="width: 10%;">{{ $participant->oral_feeding ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">WITH DEMENTIA CARE EXPERIENCE</td>
                <td class="" style="width: 10%;">{{ $participant->with_dementia_care_experience ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">ASSIST WALKING</td>
                <td class="" style="width: 10%;">{{ $participant->assist_walking ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">RECEIVED COVID-19 VACCINE INJECTION (3 DOSE)</td>
                <td class="" style="width: 10%;">{{ $participant->received_covid19_vaccine_injection_3_dose ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">I CAN INJECT DIABETES</td>
                <td class="" style="width: 10%;">{{ $participant->i_can_inject_diabetes ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">I CAN TAKE CARE OF IDIOTS</td>
                <td class="" style="width: 10%;">{{ $participant->i_can_take_care_of_idiots ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">SUCTION PHLEGM I CAN DO IT</td>
                <td class="" style="width: 10%;">{{ $participant->suction_phlegm_ican_do_it ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">I LIKE TAKE CARE OF A CHILDREN</td>
                <td class="" style="width: 10%;">{{ $participant->i_like_take_care_of_a_children ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">I LIKE TAKE CARE OF A NEWBORN BABY</td>
                <td class="" style="width: 10%;">{{ $participant->i_like_take_care_of_a_newborn_baby ? "✓" : "-" }}</td>
            </tr>
            <tr>
                <td class="bg-blue experience" style="width: 40%;font-style: italic;">I LIKE TAKE CARE OF THE ELDERLY</td>
                <td class="" style="width: 10%;">{{ $participant->i_like_take_care_of_the_elderly ? "✓" : "-" }}</td>
            </tr>
        </tbody>
    </table>

    <!-- New Job Section -->
    <table>
        <tbody>
            <tr>
                <td class="bg-blue col-25">{{ __('messages.new_job') }}</td>
                <td colspan="2" rowspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="col-25" style="vertical-align: top; padding-top: 1px; text-align: left; padding-left: 1px;">
                    {{ $participant->new_job ?? '' }}
                </td>
            </tr>
            <tr>
                <td class="bg-blue col-25">&nbsp;</td>
                <td class="bg-blue col-15">{{ __('messages.date') }}:</td>
                <td class="col-10">{{ $participant->date ? \Carbon\Carbon::parse($participant->date)->format('d/m/Y') : '' }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
