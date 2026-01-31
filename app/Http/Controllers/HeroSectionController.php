<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHeroSectionRequest;
use App\Http\Requests\UpdateHeroSectionRequest;
use App\Models\HeroSection;
use App\Models\MenuNavigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = HeroSection::orderBy('id')->get();
        $navigations = MenuNavigation::all();
        return view('admin.banners.index', compact('banners', 'navigations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $navigations = MenuNavigation::all();
        return view('admin.banners.create', compact('navigations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeroSectionRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('banner')) {
                $bannerPath = $request->file('banner')->store('banners', 'public');
                $validated['banner'] = $bannerPath;
            }

            $newDataRecord = HeroSection::create($validated);
        });

        return redirect()->route('admin.banners.index')->with('toast', ['type' => 'success', 'message' => 'Banner created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroSection $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSection $banner)
    {
        $navigations = MenuNavigation::all();
        return view('admin.banners.edit', compact('banner', 'navigations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroSectionRequest $request, HeroSection $banner)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $banner) {
            $validated = $request->validated();
            
            if ($request->hasFile('banner')) {
                $bannerPath = $request->file('banner')->store('banners', 'public');
                $validated['banner'] = $bannerPath;
            }
            
            $banner->update($validated);
        });

        return redirect()->route('admin.banners.index')->with('toast', ['type' => 'success', 'message' => 'Banner updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSection $banner)
    {
        // Closure-based transaction
        DB::transaction(function () use ($banner) {
            $banner->delete();
        });

        return redirect()->route('admin.banners.index')->with('toast', ['type' => 'success', 'message' => 'Banner deleted successfully.']);
    }
}
