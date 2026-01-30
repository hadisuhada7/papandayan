<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('id')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newDataRecord = Service::create($validated);

            if (!empty($validated['keypoint'])) {
                foreach ($validated['keypoint'] as $keypoint) {
                    $newDataRecord->keypoints()->create([
                        'keypoint' => $keypoint
                    ]);
                }
            }
        });

        return redirect()->route('admin.services.index')->with('toast', ['type' => 'success', 'message' => 'Service created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $service) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $service->update($validated);
            
            if (!empty($validated['keypoint'])) {
                $service->keypoints()->delete();

                foreach ($validated['keypoint'] as $keypoint) {
                    $service->keypoints()->create([
                        'keypoint' => $keypoint
                    ]);
                }
            }
        });

        return redirect()->route('admin.services.index')->with('toast', ['type' => 'success', 'message' => 'Service updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Closure-based transaction
        DB::transaction(function () use ($service) {
            $service->delete();
        });

        return redirect()->route('admin.services.index')->with('toast', ['type' => 'success', 'message' => 'Service deleted successfully.']);
    }
}
