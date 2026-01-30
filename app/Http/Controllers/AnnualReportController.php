<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnualReportRequest;
use App\Http\Requests\UpdateAnnualReportRequest;
use App\Models\AnnualReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnualReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = AnnualReport::orderBy('id')->get();
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnualReportRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            if ($request->hasFile('report')) {
                $reportPath = $request->file('report')->store('reports', 'public');
                $validated['report'] = $reportPath;
            }

            $newDataRecord = AnnualReport::create($validated);
        });

        return redirect()->route('admin.reports.index')->with('toast', ['type' => 'success', 'message' => 'Annual Report created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnualReport $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnualReport $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnualReportRequest $request, AnnualReport $report)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $report) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            if ($request->hasFile('report')) {
                $reportPath = $request->file('report')->store('reports', 'public');
                $validated['report'] = $reportPath;
            }

            $report->update($validated);
        });

        return redirect()->route('admin.reports.index')->with('toast', ['type' => 'success', 'message' => 'Annual Report updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnualReport $report)
    {
        // Closure-based transaction
        DB::transaction(function () use ($report) {
            $report->delete();
        });

        return redirect()->route('admin.reports.index')->with('toast', ['type' => 'success', 'message' => 'Annual Report deleted successfully.']);
    }
}
