<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvestorPresentationRequest;
use App\Http\Requests\UpdateInvestorPresentationRequest;
use App\Models\InvestorPresentation;
use App\Services\ReportSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorPresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investors = InvestorPresentation::orderBy('id')->get();
        return view('admin.investors.index', compact('investors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.investors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvestorPresentationRequest $request, ReportSubscriptionService $subscriptionService)
    {
        $presentation = null;
        $createdReports = [];

        // Closure-based transaction
        DB::transaction(function () use ($request, &$presentation, &$createdReports) {
            $validated = $request->validated();
            $presentation = InvestorPresentation::create($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportFile = $request->file("report.{$index}");
                        $reportPath = $reportFile->store('reports', 'public');
                        $createdReports[] = $presentation->investorReports()->create([
                            'name' => $name,
                            'report' => $reportPath,
                            'original_filename' => $reportFile->getClientOriginalName(),
                        ]);
                    }
                }
            }
        });

        if ($presentation && $presentation->status === 'Published' && !empty($createdReports)) {
            foreach ($createdReports as $report) {
                $subscriptionService->notifyInvestorReport($presentation, $report);
            }
        }

        return redirect()->route('admin.investors.index')->with('toast', ['type' => 'success', 'message' => 'Investor Presentation created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(InvestorPresentation $investor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvestorPresentation $investor)
    {
        return view('admin.investors.edit', compact('investor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvestorPresentationRequest $request, InvestorPresentation $investor, ReportSubscriptionService $subscriptionService)
    {
        $wasPublished = $investor->status === 'Published';
        $createdReports = [];

        // Closure-based transaction
        DB::transaction(function () use ($request, $investor, &$createdReports) {
            $validated = $request->validated();
            $investor->update($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportFile = $request->file("report.{$index}");
                        $reportPath = $reportFile->store('reports', 'public');
                        $createdReports[] = $investor->investorReports()->create([
                            'name' => $name,
                            'report' => $reportPath,
                            'original_filename' => $reportFile->getClientOriginalName(),
                        ]);
                    }
                }
            }
        });

        $investor->refresh();

        if ($investor->status === 'Published') {
            $reportsToNotify = [];
            if (!$wasPublished) {
                $reportsToNotify = $investor->investorReports()->get()->all();
            } else {
                $reportsToNotify = $createdReports;
            }

            foreach ($reportsToNotify as $report) {
                $subscriptionService->notifyInvestorReport($investor, $report);
            }
        }

        return redirect()->route('admin.investors.index')->with('toast', ['type' => 'success', 'message' => 'Investor Presentation updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvestorPresentation $investor)
    {
        // Closure-based transaction
        DB::transaction(function () use ($investor) {
            // Delete related investor reports
            $investor->investorReports()->delete();
            // Delete the investor presentation
            $investor->delete();
        });

        return redirect()->route('admin.investors.index')->with('toast', ['type' => 'success', 'message' => 'Investor Presentation deleted successfully.']);
    }
}
