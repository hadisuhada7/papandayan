<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionTypeRequest;
use App\Http\Requests\UpdateQuestionTypeRequest;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = QuestionType::orderBy('id')->get();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionTypeRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = QuestionType::create($validated);
        });

        return redirect()->route('admin.types.index')->with('toast', ['type' => 'success', 'message' => 'Question Type created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionType $questionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionType $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionTypeRequest $request, QuestionType $type)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $type) {
            $validated = $request->validated();
            $type->update($validated);
        });

        return redirect()->route('admin.types.index')->with('toast', ['type' => 'success', 'message' => 'Question Type updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionType $type)
    {
        // Closure-based transaction
        DB::transaction(function () use ($type) {
            $type->delete();
        });

        return redirect()->route('admin.types.index')->with('toast', ['type' => 'success', 'message' => 'Question Type deleted successfully.']);
    }
}
