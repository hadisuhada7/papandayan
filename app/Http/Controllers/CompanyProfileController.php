<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use App\Http\Requests\UpdateCompanyProfileRequest;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = CompanyProfile::orderBy('id')->get();
        return view('admin.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyProfileRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }
            $newDataRecord = CompanyProfile::create($validated);
        });
        return redirect()->route('admin.profiles.index')->with('toast', ['type' => 'success', 'message' => 'Profile created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyProfile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyProfile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyProfileRequest $request, CompanyProfile $profile)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $profile) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $profile->update($validated);
        });

        return redirect()->route('admin.profiles.index')->with('toast', ['type' => 'success', 'message' => 'Profile updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyProfile $profile)
    {
        // Closure-based transaction
        DB::transaction(function () use ($profile) {
            $profile->delete();
        });

        return redirect()->route('admin.profiles.index')->with('toast', ['type' => 'success', 'message' => 'Profile deleted successfully.']);
    }
}
