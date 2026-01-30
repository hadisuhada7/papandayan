<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyStatisticRequest;
use App\Http\Requests\UpdateCompanyStatisticRequest;
use App\Models\CompanyStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = CompanyStatistic::orderBy('id')->get();
        return view('admin.statistics.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statistics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyStatisticRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            $newDataRecord = CompanyStatistic::create($validated);
        });

        return redirect()->route('admin.statistics.index')->with('toast', ['type' => 'success', 'message' => 'Statistic created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyStatistic $statistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyStatistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyStatisticRequest $request, CompanyStatistic $statistic)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $statistic) {
            $validated = $request->validated();
            
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            $statistic->update($validated);
        });

        return redirect()->route('admin.statistics.index')->with('toast', ['type' => 'success', 'message' => 'Statistic updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyStatistic $statistic)
    {
        // Closure-based transaction
        DB::transaction(function () use ($statistic) {
            $statistic->delete();
        });

        return redirect()->route('admin.statistics.index')->with('toast', ['type' => 'success', 'message' => 'Statistic deleted successfully.']);
    }
}