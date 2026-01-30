<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCareerApplicantRequest;
use App\Http\Requests\StoreExperiencedApplicantRequest;
use App\Http\Requests\UpdateCareerApplicantRequest;
use App\Http\Requests\UpdateExperiencedApplicantRequest;
use App\Models\Career;
use App\Models\CareerApplicant;
use App\Models\ExperiencedApplicant;
use App\Exports\ApplicantsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CareerApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Career::withCount('career_applicants')->orderBy('id')->get();
        return view('admin.applicants.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $careers = Career::all();
        return view('admin.applicants.create', compact('careers'));
    }

    /**
     * Get applicants for a specific career position and show detail page.
     */
    public function getCareerApplicants($careerId)
    {
        try {
            $career = Career::findOrFail($careerId);
            $applicants = CareerApplicant::with('experienced_applicant')
                ->where('career_id', $careerId)
                ->orderBy('created_at', 'asc')
                ->get();

            return view('admin.applicants.detail', compact('career', 'applicants'));
        } catch (Exception $e) {
            return redirect()->route('admin.applicants.index')->with('toast', ['type' => 'error', 'message' => 'Career not found or failed to load applicants data.']);
        }
    }

    /**
     * Export applicants for specific career to Excel.
     */
    public function exportCareerApplicants($careerId)
    {
        try {
            $career = Career::findOrFail($careerId);
            $filename = 'applicants_' . str_replace(' ', '_', strtolower($career->position)) . '_' . date('Y-m-d_H-i-s') . '.xlsx';
            
            return Excel::download(new ApplicantsExport($careerId), $filename);
        } catch (Exception $e) {
            return redirect()->back()->with('toast', ['type' => 'error', 'message' => 'Career not found or failed to export applicants data.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCareerApplicantRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('curriculum_vitae')) {
                $curriculumVitaePath = $request->file('curriculum_vitae')->store('applicants', 'public');
                $validated['curriculum_vitae'] = $curriculumVitaePath;
            }

            $experiencedApplicant = null;
            if ($validated['experienced'] === 'Yes') {
                $experiencedData = [
                    'company_name' => $validated['company_name'],
                    'industry' => $validated['industry'],
                    'position' => $validated['position'],
                    'duration' => $validated['duration'],
                ];
                
                $experiencedApplicant = ExperiencedApplicant::create($experiencedData);
                $validated['experienced_id'] = $experiencedApplicant->id;
            }
            
            unset($validated['company_name'], $validated['industry'], $validated['position'], $validated['duration']);
            $newDataRecord = CareerApplicant::create($validated);
        });

        return redirect()->route('admin.applicants.index')->with('toast', ['type' => 'success', 'message' => 'Applicant created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(CareerApplicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CareerApplicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCareerApplicantRequest $request, CareerApplicant $applicant)
    {
        try {
            $validated = $request->validated();
            $updateData = [
                'status' => $validated['status']
            ];
            
            if (strtolower($validated['status']) === 'approved') {
                $updateData['reject_reason'] = null;
            } elseif (isset($validated['reject_reason'])) {
                $updateData['reject_reason'] = $validated['reject_reason'];
            }
            
            $applicant->update($updateData);
            $message = $validated['status'] === 'approved' ? 'Applicant approved successfully.' : 'Applicant rejected successfully.';
            
            return redirect()->back()->with('toast', ['type' => 'success', 'message' => $message]);
        } catch (Exception $e) {
            return redirect()->back()->with('toast', ['type' => 'error', 'message' => 'Failed to update applicant status: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CareerApplicant $applicant)
    {
        //
    }
}
