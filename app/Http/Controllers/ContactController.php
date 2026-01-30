<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('id')->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            $newDataRecord = Contact::create($validated);
        });

        return redirect()->route('admin.contacts.index')->with('toast', ['type' => 'success', 'message' => 'Contact created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $contact) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                $validated['icon'] = $iconPath;
            }

            $contact->update($validated);
        });

        return redirect()->route('admin.contacts.index')->with('toast', ['type' => 'success', 'message' => 'Contact updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        // Closure-based transaction
        DB::transaction(function () use ($contact) {
            $contact->delete();
        });

        return redirect()->route('admin.contacts.index')->with('toast', ['type' => 'success', 'message' => 'Contact deleted successfully.']);
    }
}
