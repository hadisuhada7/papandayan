<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuGroupRequest;
use App\Http\Requests\UpdateMenuGroupRequest;
use App\Models\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = MenuGroup::orderBy('id')->get();
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuGroupRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = MenuGroup::create($validated);
        });

        return redirect()->route('admin.groups.index')->with('toast', ['type' => 'success', 'message' => 'Menu Group created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuGroup $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuGroup $group)
    {
        return view('admin.groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuGroupRequest $request, MenuGroup $group)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $group) {
            $validated = $request->validated();
            $group->update($validated);
        });

        return redirect()->route('admin.groups.index')->with('toast', ['type' => 'success', 'message' => 'Menu Group updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuGroup $group)
    {
        // Closure-based transaction
        DB::transaction(function () use ($group) {
            $group->delete();
        });

        return redirect()->route('admin.groups.index')->with('toast', ['type' => 'success', 'message' => 'Menu Group deleted successfully.']);
    }
}
