<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoverageAreaRequest;
use App\Http\Requests\UpdateCoverageAreaRequest;
use App\Models\CoverageArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoverageAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = CoverageArea::orderBy('id')->get();
        return view('admin.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoverageAreaRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = CoverageArea::create($validated);
        });

        return redirect()->route('admin.areas.index')->with('toast', ['type' => 'success', 'message' => 'Area created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(CoverageArea $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoverageArea $area)
    {
        return view('admin.areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoverageAreaRequest $request, CoverageArea $area)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $area) {
            $validated = $request->validated();
            $area->update($validated);
        });

        return redirect()->route('admin.areas.index')->with('toast', ['type' => 'success', 'message' => 'Area updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoverageArea $area)
    {
        // Closure-based transaction
        DB::transaction(function () use ($area) {
            $area->delete();
        });

        return redirect()->route('admin.areas.index')->with('toast', ['type' => 'success', 'message' => 'Area deleted successfully.']);
    }
}
