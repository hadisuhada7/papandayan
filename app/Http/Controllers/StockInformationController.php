<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockInformationRequest;
use App\Http\Requests\UpdateStockInformationRequest;
use App\Models\StockInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = StockInformation::orderBy('id')->get();
        return view('admin.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockInformationRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = StockInformation::create($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportPath = $request->file("report.{$index}")->store('reports', 'public');
                        $newDataRecord->stockReports()->create([
                            'name' => $name,
                            'report' => $reportPath
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.stocks.index')->with('toast', ['type' => 'success', 'message' => 'Stock Information created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(StockInformation $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockInformation $stock)
    {
        return view('admin.stocks.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockInformationRequest $request, StockInformation $stock)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $stock) {
            $validated = $request->validated();
            $stock->update($validated);

            if (!empty($validated['name']) && !empty($request->file('report'))) {
                foreach ($validated['name'] as $index => $name) {
                    if (!empty($name) && $request->hasFile("report.{$index}")) {
                        $reportPath = $request->file("report.{$index}")->store('reports', 'public');
                        $stock->stockReports()->create([
                            'name' => $name,
                            'report' => $reportPath
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.stocks.index')->with('toast', ['type' => 'success', 'message' => 'Stock Information updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockInformation $stock)
    {
        // Closure-based transaction
        DB::transaction(function () use ($stock) {
            // Delete related stock reports
            $stock->stockReports()->delete();
            // Delete the stock information
            $stock->delete();
        });

        return redirect()->route('admin.stocks.index')->with('toast', ['type' => 'success', 'message' => 'Stock Information deleted successfully.']);
    }
}
