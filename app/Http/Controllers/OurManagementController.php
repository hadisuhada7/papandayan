<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOurManagementRequest;
use App\Http\Requests\UpdateOurManagementRequest;
use App\Models\OurManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OurManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managements = OurManagement::orderBy('id')->get();
        return view('admin.managements.index', compact('managements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.managements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOurManagementRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $validated['avatar'] = $avatarPath;
            }

            $newDataRecord = OurManagement::create($validated);
        });

        return redirect()->route('admin.managements.index')->with('toast', ['type' => 'success', 'message' => 'Management created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(OurManagement $management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OurManagement $management)
    {
        return view('admin.managements.edit', compact('management'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOurManagementRequest $request, OurManagement $management)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $management) {
            $validated = $request->validated();

            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $validated['avatar'] = $avatarPath;
            }

            $management->update($validated);
        });

        return redirect()->route('admin.managements.index')->with('toast', ['type' => 'success', 'message' => 'Management updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OurManagement $management)
    {
        // Closure-based transaction
        DB::transaction(function () use ($management) {
            $management->delete();
        });

        return redirect()->route('admin.managements.index')->with('toast', ['type' => 'success', 'message' => 'Management deleted successfully.']);
    }
}
