<?php

namespace App\Http\Controllers;

use App\Models\EmailConfig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EmailConfigController extends Controller
{
    public function index(): View
    {
        $configs = EmailConfig::orderByDesc('id')->paginate(10);

        return view('admin.email-configs.index', compact('configs'));
    }

    public function create(): View
    {
        return view('admin.email-configs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer', 'min:1'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'encryption' => ['nullable', 'string', 'max:50'],
            'from_address' => ['required', 'email', 'max:255'],
            'from_name' => ['required', 'string', 'max:255'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        DB::transaction(function () use ($validated) {
            if ($validated['is_active']) {
                EmailConfig::where('is_active', true)->update(['is_active' => false]);
            }

            EmailConfig::create($validated);
        });

        return redirect()->route('admin.email-configs.index')->with('toast', ['type' => 'success', 'message' => 'Email config created successfully.']);
    }

    public function edit(EmailConfig $emailConfig): View
    {
        return view('admin.email-configs.edit', compact('emailConfig'));
    }

    public function update(Request $request, EmailConfig $emailConfig): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer', 'min:1'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'encryption' => ['nullable', 'string', 'max:50'],
            'from_address' => ['required', 'email', 'max:255'],
            'from_name' => ['required', 'string', 'max:255'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        DB::transaction(function () use ($validated, $emailConfig) {
            if ($validated['is_active']) {
                EmailConfig::where('is_active', true)
                    ->where('id', '!=', $emailConfig->id)
                    ->update(['is_active' => false]);
            }

            $emailConfig->update($validated);
        });

        return redirect()->route('admin.email-configs.index')->with('toast', ['type' => 'success', 'message' => 'Email config updated successfully.']);
    }

    public function destroy(EmailConfig $emailConfig): RedirectResponse
    {
        DB::transaction(function () use ($emailConfig) {
            $emailConfig->delete();
        });

        return redirect()->route('admin.email-configs.index')->with('toast', ['type' => 'success', 'message' => 'Email config deleted successfully.']);
    }
}