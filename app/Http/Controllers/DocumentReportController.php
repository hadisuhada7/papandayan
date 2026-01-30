<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentReportRequest;
use App\Http\Requests\UpdateDocumentReportRequest;
use App\Models\DocumentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = DocumentReport::orderBy('id')->get();
        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentReportRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            if ($request->hasFile('report')) {
                $reportPath = $request->file('report')->store('reports', 'public');
                $validated['report'] = $reportPath;
            }

            $newDataRecord = DocumentReport::create($validated);
        });

        return redirect()->route('admin.documents.index')->with('toast', ['type' => 'success', 'message' => 'Document Report created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentReport $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentReport $document)
    {
        return view('admin.documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentReportRequest $request, DocumentReport $document)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $document) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            if ($request->hasFile('report')) {
                $reportPath = $request->file('report')->store('reports', 'public');
                $validated['report'] = $reportPath;
            }

            $document->update($validated);
        });

        return redirect()->route('admin.documents.index')->with('toast', ['type' => 'success', 'message' => 'Document Report updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentReport $document)
    {
        // Closure-based transaction
        DB::transaction(function () use ($document) {
            $document->delete();
        });
        
        return redirect()->route('admin.documents.index')->with('toast', ['type' => 'success', 'message' => 'Document Report deleted successfully.']);
    }
}
