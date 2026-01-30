<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuNavigationRequest;
use App\Http\Requests\UpdateMenuNavigationRequest;
use App\Models\MenuNavigation;
use App\Models\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuNavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $navigations = MenuNavigation::with('menu_group')->orderBy('id')->get();
        return view('admin.navigations.index', compact('navigations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = MenuGroup::all();
        return view('admin.navigations.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuNavigationRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = MenuNavigation::create($validated);
        });

        return redirect()->route('admin.navigations.index')->with('toast', ['type' => 'success', 'message' => 'Menu Navigation created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuNavigation $navigation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuNavigation $navigation)
    {
        $groups = MenuGroup::all();
        return view('admin.navigations.edit', compact('navigation', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuNavigationRequest $request, MenuNavigation $navigation)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $navigation) {
            $validated = $request->validated();
            $navigation->update($validated);
        });

        return redirect()->route('admin.navigations.index')->with('toast', ['type' => 'success', 'message' => 'Menu Navigation updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuNavigation $navigation)
    {
        // Closure-based transaction
        DB::transaction(function () use ($navigation) {
            $navigation->delete();
        });

        return redirect()->route('admin.navigations.index')->with('toast', ['type' => 'success', 'message' => 'Menu Navigation deleted successfully.']);
    }
}
