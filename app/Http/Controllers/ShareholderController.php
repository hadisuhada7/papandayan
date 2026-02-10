<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShareholderRequest;
use App\Http\Requests\UpdateShareholderRequest;
use App\Models\Shareholder;
use App\Services\ReportSubscriptionService;
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
    public function store(StoreShareholderRequest $request, ReportSubscriptionService $subscriptionService)
    {
        $shareholder = null;
        $createdReports = [];

        // Closure-based transaction
        DB::transaction(function () use ($request, &$shareholder, &$createdReports) {
            $validated = $request->validated();
            $shareholder = Shareholder::create($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportFile = $request->file("report.{$index}");
                        $reportPath = $reportFile->store('reports', 'public');
                        $createdReports[] = $shareholder->shareholderReports()->create([
                            'name' => $name,
                            'report' => $reportPath,
                            'original_filename' => $reportFile->getClientOriginalName(),
                        ]);
                    }
                }
            }
        });

        if ($shareholder && $shareholder->status === 'Published' && !empty($createdReports)) {
            foreach ($createdReports as $report) {
                $subscriptionService->notifyShareholderReport($shareholder, $report);
            }
        }

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
    public function update(UpdateShareholderRequest $request, Shareholder $shareholder, ReportSubscriptionService $subscriptionService)
    {
        $wasPublished = $shareholder->status === 'Published';
        $createdReports = [];

        // Closure-based transaction
        DB::transaction(function () use ($request, $shareholder, &$createdReports) {
            $validated = $request->validated();
            $shareholder->update($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportFile = $request->file("report.{$index}");
                        $reportPath = $reportFile->store('reports', 'public');
                        $createdReports[] = $shareholder->shareholderReports()->create([
                            'name' => $name,
                            'report' => $reportPath,
                            'original_filename' => $reportFile->getClientOriginalName(),
                        ]);
                    }
                }
            }
        });

        $shareholder->refresh();

        if ($shareholder->status === 'Published') {
            $reportsToNotify = [];
            if (!$wasPublished) {
                $reportsToNotify = $shareholder->shareholderReports()->get()->all();
            } else {
                $reportsToNotify = $createdReports;
            }

            foreach ($reportsToNotify as $report) {
                $subscriptionService->notifyShareholderReport($shareholder, $report);
            }
        }

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
