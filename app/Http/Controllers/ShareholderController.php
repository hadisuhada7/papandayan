<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShareholderRequest;
use App\Http\Requests\UpdateShareholderRequest;
use App\Models\Shareholder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShareholderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shareholders = Shareholder::orderBy('id')->get();
        return view('admin.shareholders.index', compact('shareholders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shareholders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShareholderRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = Shareholder::create($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportPath = $request->file("report.{$index}")->store('reports', 'public');
                        $newDataRecord->shareholderReports()->create([
                            'name' => $name,
                            'report' => $reportPath
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.shareholders.index')->with('toast', ['type' => 'success', 'message' => 'Shareholder created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shareholder $shareholder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shareholder $shareholder)
    {
        return view('admin.shareholders.edit', compact('shareholder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShareholderRequest $request, Shareholder $shareholder)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $shareholder) {
            $validated = $request->validated();
            $shareholder->update($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportPath = $request->file("report.{$index}")->store('reports', 'public');
                        $shareholder->shareholderReports()->create([
                            'name' => $name,
                            'report' => $reportPath
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.shareholders.index')->with('toast', ['type' => 'success', 'message' => 'Shareholder updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shareholder $shareholder)
    {
        // Closure-based transaction
        DB::transaction(function () use ($shareholder) {
            // Delete related shareholder reports
            $shareholder->shareholderReports()->delete();
            // Delete the shareholder
            $shareholder->delete();
        });

        return redirect()->route('admin.shareholders.index')->with('toast', ['type' => 'success', 'message' => 'Shareholder deleted successfully.']);
    }
}
