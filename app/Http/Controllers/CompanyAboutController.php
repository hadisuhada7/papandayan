<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyAboutRequest;
use App\Http\Requests\UpdateCompanyAboutRequest;
use App\Models\CompanyAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = CompanyAbout::orderBy('id')->get();
        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyAboutRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newDataRecord = CompanyAbout::create($validated);

            if (!empty($validated['keypoint'])) {
                foreach ($validated['keypoint'] as $keypoint) {
                    $newDataRecord->keypoints()->create([
                        'keypoint' => $keypoint
                    ]);
                }
            }
        });

        return redirect()->route('admin.abouts.index')->with('toast', ['type' => 'success', 'message' => 'About created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyAbout $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyAbout $about)
    {
        return view('admin.abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyAboutRequest $request, CompanyAbout $about)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $about) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $about->update($validated);

            if(!empty($validated['keypoint'])) {
                $about->keypoints()->delete();
                
                foreach ($validated['keypoint'] as $keypoint) {
                    $about->keypoints()->create([
                        'keypoint' => $keypoint
                    ]);
                }
            }
        });

        return redirect()->route('admin.abouts.index')->with('toast', ['type' => 'success', 'message' => 'About updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyAbout $about)
    {
        // Closure-based transaction
        DB::transaction(function () use ($about) {
            $about->delete();
        });

        return redirect()->route('admin.abouts.index')->with('toast', ['type' => 'success', 'message' => 'About deleted successfully.']);
    }
}
