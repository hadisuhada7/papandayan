<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFinancialStatementRequest;
use App\Http\Requests\UpdateFinancialStatementRequest;
use App\Models\FinancialStatement;
use App\Services\ReportSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financials = FinancialStatement::orderBy('id')->get();
        return view('admin.financials.index', compact('financials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.financials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFinancialStatementRequest $request, ReportSubscriptionService $subscriptionService)
    {
        $financial = null;
        $createdReports = [];

        // Closure-based transaction
        DB::transaction(function () use ($request, &$financial, &$createdReports) {
            $validated = $request->validated();
            $financial = FinancialStatement::create($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportPath = $request->file("report.{$index}")->store('reports', 'public');
                        $createdReports[] = $financial->financialReports()->create([
                            'name' => $name,
                            'report' => $reportPath
                        ]);
                    }
                }
            }
        });

        if ($financial && $financial->status === 'Published' && !empty($createdReports)) {
            foreach ($createdReports as $report) {
                $subscriptionService->notifyFinancialReport($financial, $report);
            }
        }

        return redirect()->route('admin.financials.index')->with('toast', ['type' => 'success', 'message' => 'Financial Statement created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialStatement $financial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialStatement $financial)
    {
        return view('admin.financials.edit', compact('financial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinancialStatementRequest $request, FinancialStatement $financial, ReportSubscriptionService $subscriptionService)
    {
        $wasPublished = $financial->status === 'Published';
        $createdReports = [];

        // Closure-based transaction
        DB::transaction(function () use ($request, $financial, &$createdReports) {
            $validated = $request->validated();
            $financial->update($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportPath = $request->file("report.{$index}")->store('reports', 'public');
                        $createdReports[] = $financial->financialReports()->create([
                            'name' => $name,
                            'report' => $reportPath
                        ]);
                    }
                }
            }
        });

        $financial->refresh();

        if ($financial->status === 'Published') {
            $reportsToNotify = [];
            if (!$wasPublished) {
                $reportsToNotify = $financial->financialReports()->get()->all();
            } else {
                $reportsToNotify = $createdReports;
            }

            foreach ($reportsToNotify as $report) {
                $subscriptionService->notifyFinancialReport($financial, $report);
            }
        }

        return redirect()->route('admin.financials.index')->with('toast', ['type' => 'success', 'message' => 'Financial Statement updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialStatement $financial)
    {
        // Closure-based transaction
        DB::transaction(function () use ($financial) {
            // Delete related financial reports
            $financial->financialReports()->delete();
            // Delete the financial statement
            $financial->delete();
        });

        return redirect()->route('admin.financials.index')->with('toast', ['type' => 'success', 'message' => 'Financial Statement deleted successfully.']);
    }
}
