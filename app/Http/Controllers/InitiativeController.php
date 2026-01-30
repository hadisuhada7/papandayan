<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInitiativeRequest;
use App\Http\Requests\UpdateInitiativeRequest;
use App\Models\Initiative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InitiativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $initiatives = Initiative::orderBy('id')->get();
        return view('admin.initiatives.index', compact('initiatives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.initiatives.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInitiativeRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newDataRecord = Initiative::create($validated);
        });

        return redirect()->route('admin.initiatives.index')->with('toast', ['type' => 'success', 'message' => 'Initiative created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Initiative $initiative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Initiative $initiative)
    {
        return view('admin.initiatives.edit', compact('initiative'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInitiativeRequest $request, Initiative $initiative)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $initiative) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $initiative->update($validated);
        });

        return redirect()->route('admin.initiatives.index')->with('toast', ['type' => 'success', 'message' => 'Initiative updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Initiative $initiative)
    {
        // Closure-based transaction
        DB::transaction(function () use ($initiative) {
            $initiative->delete();
        });
        
        return redirect()->route('admin.initiatives.index')->with('toast', ['type' => 'success', 'message' => 'Initiative deleted successfully.']);
    }
}
