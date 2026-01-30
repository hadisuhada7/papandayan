<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorporateSocialRequest;
use App\Http\Requests\UpdateCorporateSocialRequest;
use App\Models\CorporateSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorporateSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials = CorporateSocial::orderBy('id')->get();
        return view('admin.socials.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCorporateSocialRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newDataRecord = CorporateSocial::create($validated);
        });

        return redirect()->route('admin.socials.index')->with('toast', ['type' => 'success', 'message' => 'Corporate Social created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(CorporateSocial $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CorporateSocial $social)
    {
        return view('admin.socials.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCorporateSocialRequest $request, CorporateSocial $social)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $social) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $social->update($validated);
        });

        return redirect()->route('admin.socials.index')->with('toast', ['type' => 'success', 'message' => 'Corporate Social updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CorporateSocial $social)
    {
        // Closure-based transaction
        DB::transaction(function () use ($social) {
            $social->delete();
        });

        return redirect()->route('admin.socials.index')->with('toast', ['type' => 'success', 'message' => 'Corporate Social deleted successfully.']);
    }
}
