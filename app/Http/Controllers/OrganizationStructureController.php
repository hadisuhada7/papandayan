<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationStructureRequest;
use App\Http\Requests\UpdateOrganizationStructureRequest;
use App\Models\OrganizationStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = OrganizationStructure::orderBy('id')->get();
        return view('admin.organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationStructureRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newDataRecord = OrganizationStructure::create($validated);
        });

        return redirect()->route('admin.organizations.index')->with('toast', ['type' => 'success', 'message' => 'Organization created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrganizationStructure $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrganizationStructure $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationStructureRequest $request, OrganizationStructure $organization)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $organization) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $organization->update($validated);
        });

        return redirect()->route('admin.organizations.index')->with('toast', ['type' => 'success', 'message' => 'Organization updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrganizationStructure $organization)
    {
        // Closure-based transaction
        DB::transaction(function () use ($organization) {
            $organization->delete();
        });

        return redirect()->route('admin.organizations.index')->with('toast', ['type' => 'success', 'message' => 'Organization deleted successfully.']);
    }
}
