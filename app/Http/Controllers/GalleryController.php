<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('id')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $newDataRecord = Gallery::create($validated);
        });

        return redirect()->route('admin.galleries.index')->with('toast', ['type' => 'success', 'message' => 'Gallery created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $gallery) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $gallery->update($validated);
        });

        return redirect()->route('admin.galleries.index')->with('toast', ['type' => 'success', 'message' => 'Gallery updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Closure-based transaction
        DB::transaction(function () use ($gallery) {
            $gallery->delete();
        });

        return redirect()->route('admin.galleries.index')->with('toast', ['type' => 'success', 'message' => 'Gallery deleted successfully.']);
    }
}
