<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('question_type')->orderBy('id')->get();
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = QuestionType::all();
        return view('admin.questions.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newDataRecord = Question::create($validated);
        });

        return redirect()->route('admin.questions.index')->with('toast', ['type' => 'success', 'message' => 'Question created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $types = QuestionType::all();
        return view('admin.questions.edit', compact('question', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $question) {
            $validated = $request->validated();
            $question->update($validated);
        });

        return redirect()->route('admin.questions.index')->with('toast', ['type' => 'success', 'message' => 'Question updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        // Closure-based transaction
        DB::transaction(function () use ($question) {
            $question->delete();
        });

        return redirect()->route('admin.questions.index')->with('toast', ['type' => 'success', 'message' => 'Question deleted successfully.']);
    }
}
