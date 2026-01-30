<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCareerRequest;
use App\Http\Requests\UpdateCareerRequest;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Career::orderBy('id')->get();
        return view('admin.careers.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCareerRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newDataRecord = Career::create($validated);
        });

        return redirect()->route('admin.careers.index')->with('toast', ['type' => 'success', 'message' => 'Career created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCareerRequest $request, Career $career)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $career) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $career->update($validated);
        });

        return redirect()->route('admin.careers.index')->with('toast', ['type' => 'success', 'message' => 'Career updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        // Closure-based transaction
        DB::transaction(function () use ($career) {
            $career->delete();
        });

        return redirect()->route('admin.careers.index')->with('toast', ['type' => 'success', 'message' => 'Career deleted successfully.']);
    }
}
