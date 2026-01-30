<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('id')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $validated['avatar'] = $avatarPath;
            }

            $newDataRecord = Testimonial::create($validated);
        });

        return redirect()->route('admin.testimonials.index')->with('toast', ['type' => 'success', 'message' => 'Testimonial created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $testimonial) {
            $validated = $request->validated();
            
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $validated['avatar'] = $avatarPath;
            }

            $testimonial->update($validated);
        });

        return redirect()->route('admin.testimonials.index')->with('toast', ['type' => 'success', 'message' => 'Testimonial updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Closure-based transaction
        DB::transaction(function () use ($testimonial) {
            $testimonial->delete();
        });

        return redirect()->route('admin.testimonials.index')->with('toast', ['type' => 'success', 'message' => 'Testimonial deleted successfully.']);
    }
}
