<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSafetyManagementRequest;
use App\Http\Requests\UpdateSafetyManagementRequest;
use App\Models\SafetyManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SafetyManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $safeties = SafetyManagement::orderBy('id')->get();
        return view('admin.safeties.index', compact('safeties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.safeties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSafetyManagementRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = SafetyManagement::create($validated);
        });

        return redirect()->route('admin.safeties.index')->with('toast', ['type' => 'success', 'message' => 'Safety Management created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(SafetyManagement $safety)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SafetyManagement $safety)
    {
        return view('admin.safeties.edit', compact('safety'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSafetyManagementRequest $request, SafetyManagement $safety)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $safety) {
            $validated = $request->validated();
            $safety->update($validated);
        });

        return redirect()->route('admin.safeties.index')->with('toast', ['type' => 'success', 'message' => 'Safety Management updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SafetyManagement $safety)
    {
        // Closure-based transaction
        DB::transaction(function () use ($safety) {
            $safety->delete();
        });
        
        return redirect()->route('admin.safeties.index')->with('toast', ['type' => 'success', 'message' => 'Safety Management deleted successfully.']);
    }
}
