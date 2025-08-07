<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\ParticipantWorkHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Participant::query();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('code', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nationality', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('education', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('religion', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('status', 'LIKE', "%{$searchTerm}%");
            });
            
            Log::info('Search performed', ['search_term' => $searchTerm]);
        }

        // Sort by creation date (newest first)
        $query->orderBy('created_at', 'desc');
        
        // Pagination with 5 items per page
        $participants = $query->paginate(5)->withQueryString();
        
        return view('contents.pages.participant.index', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contents.pages.participant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug: Log incoming request data (remove in production)
        Log::info('Participant creation attempt', [
            'request_data' => $request->except(['photo_path', '_token'])
        ]);

        // Validation rules
        $request->validate([
            'code' => 'required|string|max:255|unique:participants,code',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:255',
            'height' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1',
            'religion' => 'required|string|max:255',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'education' => 'required|string|max:255',
            'no_of_children' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'hongkong_year' => 'nullable|integer|min:0',
            'singapore_year' => 'nullable|integer|min:0',
            'taiwan_year' => 'nullable|integer|min:0',
            'malaysia_year' => 'nullable|integer|min:0',
            'brunei_year' => 'nullable|integer|min:0',
            'cantonese' => 'nullable|in:learning,basic,good',
            'mandarine' => 'nullable|in:learning,basic,good',
            'english' => 'nullable|in:learning,basic,good',
            'photo_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            
            // Experience/Skills validation - all boolean fields
            'elderly_healthy_care_experience' => 'nullable|boolean',
            'elderly_sick_care_experience' => 'nullable|boolean',
            'elderly_healthy_care_experience_v' => 'nullable|boolean',
            'elderly_sick_care_experience_v' => 'nullable|boolean',
            'newborn_care_experience' => 'nullable|boolean',
            'children_care_experience' => 'nullable|boolean',
            'i_can_take_care_of_dog' => 'nullable|boolean',
            'i_can_take_care_of_cat' => 'nullable|boolean',
            'cooking_cleaning_washing_ironing_go_to_market' => 'nullable|boolean',
            'i_can_wash_car' => 'nullable|boolean',
            'shuttle_school' => 'nullable|boolean',
            'assist_toileting_change_diaper_bath_experience' => 'nullable|boolean',
            'go_to_hospital_handle_medication_experience' => 'nullable|boolean',
            'do_exercise' => 'nullable|boolean',
            'use_wheelchair' => 'nullable|boolean',
            'provide_daily_assistance' => 'nullable|boolean',
            'oral_feeding' => 'nullable|boolean',
            'with_dementia_care_experience' => 'nullable|boolean',
            'assist_walking' => 'nullable|boolean',
            'received_covid19_vaccine_injection_3_dose' => 'nullable|boolean',
            'i_can_inject_diabetes' => 'nullable|boolean',
            'i_can_take_care_of_idiots' => 'nullable|boolean',
            'suction_phlegm_ican_do_it' => 'nullable|boolean',
            'i_like_take_care_of_a_children' => 'nullable|boolean',
            'i_like_take_care_of_a_newborn_baby' => 'nullable|boolean',
            'i_like_take_care_of_the_elderly' => 'nullable|boolean',
            
            // Work history validation
            'work_history' => 'nullable|array',
            'work_history.*.country' => 'nullable|string|max:255',
            'work_history.*.period' => 'nullable|string|max:255',
            'work_history.*.target' => 'nullable|string|max:255',
            'work_history.*.reason_for_leaving' => 'nullable|string|max:255',
            'work_history.*.remake' => 'nullable|string',
        ]);

        try {
            // Debug: Log validation passed
            Log::info('Validation passed for participant creation');

            // Ensure storage directory exists
            $storageDir = storage_path('app/public/participants/photos');
            if (!file_exists($storageDir)) {
                mkdir($storageDir, 0755, true);
                Log::info('Created storage directory: ' . $storageDir);
            }

            // Handle photo upload
            $photoPath = null;
            if ($request->hasFile('photo_path')) {
                Log::info('Photo file detected');
                $photo = $request->file('photo_path');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photoPath = $photo->storeAs('participants/photos', $photoName, 'public');
                Log::info('Photo uploaded successfully: ' . $photoPath);
            } else {
                Log::warning('No photo file in request');
            }

            // Prepare participant data
            $participantData = $request->except(['photo_path', 'work_history', '_token']);
            Log::info('Participant data prepared', ['data_keys' => array_keys($participantData)]);
            
            // Add photo path
            if ($photoPath) {
                $participantData['photo_path'] = $photoPath;
            }

            // Handle boolean fields (checkboxes)
            $booleanFields = [
                'elderly_healthy_care_experience',
                'elderly_sick_care_experience',
                'elderly_healthy_care_experience_v',
                'elderly_sick_care_experience_v',
                'newborn_care_experience',
                'children_care_experience',
                'i_can_take_care_of_dog',
                'i_can_take_care_of_cat',
                'cooking_cleaning_washing_ironing_go_to_market',
                'i_can_wash_car',
                'shuttle_school',
                'assist_toileting_change_diaper_bath_experience',
                'go_to_hospital_handle_medication_experience',
                'do_exercise',
                'use_wheelchair',
                'provide_daily_assistance',
                'oral_feeding',
                'with_dementia_care_experience',
                'assist_walking',
                'received_covid19_vaccine_injection_3_dose',
                'i_can_inject_diabetes',
                'i_can_take_care_of_idiots',
                'suction_phlegm_ican_do_it',
                'i_like_take_care_of_a_children',
                'i_like_take_care_of_a_newborn_baby',
                'i_like_take_care_of_the_elderly',
            ];

            // Set boolean fields to 0 if not present (unchecked checkboxes)
            foreach ($booleanFields as $field) {
                $participantData[$field] = $request->has($field) ? 1 : 0;
            }

            // Handle experience fields with default values
            $experienceFields = ['hongkong_year', 'singapore_year', 'taiwan_year', 'malaysia_year', 'brunei_year'];
            foreach ($experienceFields as $field) {
                $participantData[$field] = $request->input($field, 0); // Default to 0 if empty
            }

            // Handle language fields (allow null if empty)
            $languageFields = ['cantonese', 'mandarine', 'english'];
            foreach ($languageFields as $field) {
                $participantData[$field] = $request->input($field) ?: null; // Set to null if empty
            }

            Log::info('Boolean fields processed', ['boolean_count' => count($booleanFields)]);

            // Create participant
            Log::info('Attempting to create participant');
            $participant = Participant::create($participantData);
            Log::info('Participant created successfully', ['participant_id' => $participant->id]);

            // Handle work history
            if ($request->has('work_history') && is_array($request->work_history)) {
                Log::info('Processing work history', ['work_history_count' => count($request->work_history)]);
                foreach ($request->work_history as $index => $workHistory) {
                    // Only create work history if at least one field is filled
                    if (!empty(array_filter($workHistory))) {
                        $workHistoryRecord = ParticipantWorkHistory::create([
                            'participant_id' => $participant->id,
                            'country' => $workHistory['country'] ?? null,
                            'period' => $workHistory['period'] ?? null,
                            'target' => $workHistory['target'] ?? null,
                            'reason_for_leaving' => $workHistory['reason_for_leaving'] ?? null,
                            'remake' => $workHistory['remake'] ?? null,
                        ]);
                        Log::info('Work history created', ['work_history_id' => $workHistoryRecord->id, 'index' => $index]);
                    }
                }
            }

            Log::info('Participant creation completed successfully');

            return redirect()->route('participants.index')
                ->with('success', 'Participant created successfully!');

        } catch (\Exception $e) {
            // Log the detailed error for debugging
            Log::error('Failed to create participant: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['photo_path', '_token']) // Exclude file and token for security
            ]);

            // Delete uploaded photo if participant creation fails
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }

            // Return with detailed error in development environment
            $errorMessage = 'Failed to create participant. Please try again.';
            if (config('app.debug')) {
                $errorMessage .= ' Error: ' . $e->getMessage();
            }

            return redirect()->back()
                ->withInput()
                ->with('error', $errorMessage);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $participant = Participant::with('workHistories')->findOrFail($id);
        return view('contents.pages.participant.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $participant = Participant::with('workHistories')->findOrFail($id);
        return view('contents.pages.participant.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $participant = Participant::findOrFail($id);

        // Debug: Log incoming request data (remove in production)
        Log::info('Participant update attempt', [
            'participant_id' => $id,
            'request_data' => $request->except(['photo_path', '_token'])
        ]);

        // Validation rules (code must be unique except for current participant)
        $request->validate([
            'code' => 'required|string|max:255|unique:participants,code,' . $id,
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:255',
            'height' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1',
            'religion' => 'required|string|max:255',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'education' => 'required|string|max:255',
            'no_of_children' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'hongkong_year' => 'nullable|integer|min:0',
            'singapore_year' => 'nullable|integer|min:0',
            'taiwan_year' => 'nullable|integer|min:0',
            'malaysia_year' => 'nullable|integer|min:0',
            'brunei_year' => 'nullable|integer|min:0',
            'cantonese' => 'nullable|in:learning,basic,good',
            'mandarine' => 'nullable|in:learning,basic,good',
            'english' => 'nullable|in:learning,basic,good',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max, optional for update
            
            // Experience/Skills validation - all boolean fields
            'elderly_healthy_care_experience' => 'nullable|boolean',
            'elderly_sick_care_experience' => 'nullable|boolean',
            'elderly_healthy_care_experience_v' => 'nullable|boolean',
            'elderly_sick_care_experience_v' => 'nullable|boolean',
            'newborn_care_experience' => 'nullable|boolean',
            'children_care_experience' => 'nullable|boolean',
            'i_can_take_care_of_dog' => 'nullable|boolean',
            'i_can_take_care_of_cat' => 'nullable|boolean',
            'cooking_cleaning_washing_ironing_go_to_market' => 'nullable|boolean',
            'i_can_wash_car' => 'nullable|boolean',
            'shuttle_school' => 'nullable|boolean',
            'assist_toileting_change_diaper_bath_experience' => 'nullable|boolean',
            'go_to_hospital_handle_medication_experience' => 'nullable|boolean',
            'do_exercise' => 'nullable|boolean',
            'use_wheelchair' => 'nullable|boolean',
            'provide_daily_assistance' => 'nullable|boolean',
            'oral_feeding' => 'nullable|boolean',
            'with_dementia_care_experience' => 'nullable|boolean',
            'assist_walking' => 'nullable|boolean',
            'received_covid19_vaccine_injection_3_dose' => 'nullable|boolean',
            'i_can_inject_diabetes' => 'nullable|boolean',
            'i_can_take_care_of_idiots' => 'nullable|boolean',
            'suction_phlegm_ican_do_it' => 'nullable|boolean',
            'i_like_take_care_of_a_children' => 'nullable|boolean',
            'i_like_take_care_of_a_newborn_baby' => 'nullable|boolean',
            'i_like_take_care_of_the_elderly' => 'nullable|boolean',
            
            // Work history validation
            'work_history' => 'nullable|array',
            'work_history.*.country' => 'nullable|string|max:255',
            'work_history.*.period' => 'nullable|string|max:255',
            'work_history.*.target' => 'nullable|string|max:255',
            'work_history.*.reason_for_leaving' => 'nullable|string|max:255',
            'work_history.*.remake' => 'nullable|string',
        ]);

        try {
            // Debug: Log validation passed
            Log::info('Validation passed for participant update');

            // Handle photo upload
            $photoPath = $participant->photo_path; // Keep existing photo by default
            if ($request->hasFile('photo_path')) {
                Log::info('New photo file detected');
                
                // Delete old photo if exists
                if ($participant->photo_path) {
                    Storage::disk('public')->delete($participant->photo_path);
                }
                
                // Upload new photo
                $photo = $request->file('photo_path');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photoPath = $photo->storeAs('participants/photos', $photoName, 'public');
                Log::info('New photo uploaded successfully: ' . $photoPath);
            }

            // Prepare participant data
            $participantData = $request->except(['photo_path', 'work_history', '_token', '_method']);
            Log::info('Participant data prepared for update', ['data_keys' => array_keys($participantData)]);
            
            // Add photo path
            $participantData['photo_path'] = $photoPath;

            // Handle boolean fields (checkboxes)
            $booleanFields = [
                'elderly_healthy_care_experience',
                'elderly_sick_care_experience',
                'elderly_healthy_care_experience_v',
                'elderly_sick_care_experience_v',
                'newborn_care_experience',
                'children_care_experience',
                'i_can_take_care_of_dog',
                'i_can_take_care_of_cat',
                'cooking_cleaning_washing_ironing_go_to_market',
                'i_can_wash_car',
                'shuttle_school',
                'assist_toileting_change_diaper_bath_experience',
                'go_to_hospital_handle_medication_experience',
                'do_exercise',
                'use_wheelchair',
                'provide_daily_assistance',
                'oral_feeding',
                'with_dementia_care_experience',
                'assist_walking',
                'received_covid19_vaccine_injection_3_dose',
                'i_can_inject_diabetes',
                'i_can_take_care_of_idiots',
                'suction_phlegm_ican_do_it',
                'i_like_take_care_of_a_children',
                'i_like_take_care_of_a_newborn_baby',
                'i_like_take_care_of_the_elderly',
            ];

            // Set boolean fields to 0 if not present (unchecked checkboxes)
            foreach ($booleanFields as $field) {
                $participantData[$field] = $request->has($field) ? 1 : 0;
            }

            // Handle experience fields with default values
            $experienceFields = ['hongkong_year', 'singapore_year', 'taiwan_year', 'malaysia_year', 'brunei_year'];
            foreach ($experienceFields as $field) {
                $participantData[$field] = $request->input($field, 0); // Default to 0 if empty
            }

            // Handle language fields (allow null if empty)
            $languageFields = ['cantonese', 'mandarine', 'english'];
            foreach ($languageFields as $field) {
                $participantData[$field] = $request->input($field) ?: null; // Set to null if empty
            }

            Log::info('Boolean and special fields processed');

            // Update participant
            Log::info('Attempting to update participant');
            $participant->update($participantData);
            Log::info('Participant updated successfully', ['participant_id' => $participant->id]);

            // Handle work history - delete existing and create new ones
            $participant->workHistories()->delete();
            
            if ($request->has('work_history') && is_array($request->work_history)) {
                Log::info('Processing work history update', ['work_history_count' => count($request->work_history)]);
                foreach ($request->work_history as $index => $workHistory) {
                    // Only create work history if at least one field is filled
                    if (!empty(array_filter($workHistory))) {
                        $workHistoryRecord = ParticipantWorkHistory::create([
                            'participant_id' => $participant->id,
                            'country' => $workHistory['country'] ?? null,
                            'period' => $workHistory['period'] ?? null,
                            'target' => $workHistory['target'] ?? null,
                            'reason_for_leaving' => $workHistory['reason_for_leaving'] ?? null,
                            'remake' => $workHistory['remake'] ?? null,
                        ]);
                        Log::info('Work history updated', ['work_history_id' => $workHistoryRecord->id, 'index' => $index]);
                    }
                }
            }

            Log::info('Participant update completed successfully');

            return redirect()->route('participants.index')
                ->with('success', 'Participant updated successfully!');

        } catch (\Exception $e) {
            // Log the detailed error for debugging
            Log::error('Failed to update participant: ' . $e->getMessage(), [
                'participant_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['photo_path', '_token']) // Exclude file and token for security
            ]);

            // Return with detailed error in development environment
            $errorMessage = 'Failed to update participant. Please try again.';
            if (config('app.debug')) {
                $errorMessage .= ' Error: ' . $e->getMessage();
            }

            return redirect()->back()
                ->withInput()
                ->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $participant = Participant::with('workHistories')->findOrFail($id);
            
            // Debug: Log delete attempt
            Log::info('Participant deletion attempt', [
                'participant_id' => $id,
                'participant_code' => $participant->code,
                'participant_name' => $participant->name
            ]);

            // Delete associated photo if exists
            if ($participant->photo_path) {
                Storage::disk('public')->delete($participant->photo_path);
                Log::info('Photo deleted successfully', ['photo_path' => $participant->photo_path]);
            }

            // Delete associated work histories (cascade should handle this, but let's be explicit)
            $participant->workHistories()->delete();
            Log::info('Work histories deleted successfully', ['count' => $participant->workHistories->count()]);

            // Delete the participant
            $participantName = $participant->name;
            $participantCode = $participant->code;
            $participant->delete();
            
            Log::info('Participant deleted successfully', [
                'participant_id' => $id,
                'participant_code' => $participantCode,
                'participant_name' => $participantName
            ]);

            return redirect()->route('participants.index')
                ->with('success', "Participant '{$participantName}' ({$participantCode}) deleted successfully!");

        } catch (\Exception $e) {
            // Log the detailed error for debugging
            Log::error('Failed to delete participant: ' . $e->getMessage(), [
                'participant_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return with detailed error in development environment
            $errorMessage = 'Failed to delete participant. Please try again.';
            if (config('app.debug')) {
                $errorMessage .= ' Error: ' . $e->getMessage();
            }

            return redirect()->back()
                ->with('error', $errorMessage);
        }
    }

    /**
     * Debug method to check what's happening (remove in production)
     */
    public function debug()
    {
        // Check database connection
        try {
            DB::connection()->getPdo();
            $dbStatus = "Database connection: OK";
        } catch (\Exception $e) {
            $dbStatus = "Database connection failed: " . $e->getMessage();
        }

        // Check storage directory permissions
        $storageWritable = is_writable(storage_path('app/public/participants/photos'));
        $storageExists = file_exists(storage_path('app/public/participants/photos'));
        
        if (!$storageExists) {
            mkdir(storage_path('app/public/participants/photos'), 0755, true);
            $storageExists = file_exists(storage_path('app/public/participants/photos'));
        }

        // Check participants table structure
        $tableInfo = DB::select("DESCRIBE participants");

        return response()->json([
            'database_status' => $dbStatus,
            'storage_exists' => $storageExists,
            'storage_writable' => $storageWritable,
            'storage_path' => storage_path('app/public/participants/photos'),
            'table_structure' => $tableInfo,
            'app_debug' => config('app.debug'),
            'app_env' => config('app.env'),
        ]);
    }

    /**
     * Test participant creation without file upload (debugging)
     */
    public function testCreate()
    {
        try {
            // Create test participant data
            $testData = [
                'code' => 'TEST-' . time(),
                'name' => 'Test Participant',
                'gender' => 'male',
                'birth_date' => '1990-01-01',
                'nationality' => 'Indonesian',
                'height' => 170,
                'weight' => 70,
                'religion' => 'Islam',
                'marital_status' => 'single',
                'education' => 'Bachelor',
                'no_of_children' => 0,
                'status' => 'Active',
                'hongkong_year' => 2,
                'singapore_year' => 1,
                'taiwan_year' => 0,
                'malaysia_year' => 3,
                'brunei_year' => 0,
                'cantonese' => rand(0, 1) ? ['learning', 'basic', 'good'][rand(0, 2)] : null,
                'mandarine' => rand(0, 1) ? ['learning', 'basic', 'good'][rand(0, 2)] : null,
                'english' => rand(0, 1) ? ['learning', 'basic', 'good'][rand(0, 2)] : null,
                'photo_path' => null,
            ];

            // Add boolean fields
            $booleanFields = [
                'elderly_healthy_care_experience',
                'elderly_sick_care_experience',
                'elderly_healthy_care_experience_v',
                'elderly_sick_care_experience_v',
                'newborn_care_experience',
                'children_care_experience',
                'i_can_take_care_of_dog',
                'i_can_take_care_of_cat',
                'cooking_cleaning_washing_ironing_go_to_market',
                'i_can_wash_car',
                'shuttle_school',
                'assist_toileting_change_diaper_bath_experience',
                'go_to_hospital_handle_medication_experience',
                'do_exercise',
                'use_wheelchair',
                'provide_daily_assistance',
                'oral_feeding',
                'with_dementia_care_experience',
                'assist_walking',
                'received_covid19_vaccine_injection_3_dose',
                'i_can_inject_diabetes',
                'i_can_take_care_of_idiots',
                'suction_phlegm_ican_do_it',
                'i_like_take_care_of_a_children',
                'i_like_take_care_of_a_newborn_baby',
                'i_like_take_care_of_the_elderly',
            ];

            foreach ($booleanFields as $field) {
                $testData[$field] = rand(0, 1);
            }

            $participant = Participant::create($testData);

            return response()->json([
                'success' => true,
                'message' => 'Test participant created successfully',
                'participant_id' => $participant->id,
                'participant_code' => $participant->code,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
