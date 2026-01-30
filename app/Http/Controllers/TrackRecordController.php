<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrackRecordRequest;
use App\Http\Requests\UpdateTrackRecordRequest;
use App\Models\TrackRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = TrackRecord::orderBy('id')->get();
        return view('admin.histories.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.histories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrackRecordRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = TrackRecord::create($validated);
        });

        return redirect()->route('admin.histories.index')->with('toast', ['type' => 'success', 'message' => 'History created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(TrackRecord $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrackRecord $history)
    {
        return view('admin.histories.edit', compact('history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrackRecordRequest $request, TrackRecord $history)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $history) {
            $validated = $request->validated();
            $history->update($validated);
        });

        return redirect()->route('admin.histories.index')->with('toast', ['type' => 'success', 'message' => 'History updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrackRecord $history)
    {
        // Closure-based transaction
        DB::transaction(function () use ($history) {
            $history->delete();
        });

        return redirect()->route('admin.histories.index')->with('toast', ['type' => 'success', 'message' => 'History deleted successfully.']);
    }
}
