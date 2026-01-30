<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Helpers\TicketNumberHelper;
use App\Models\Question;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(): View
    {
        $tickets = Ticket::with('question')->latest('id')->paginate(10);
        $stats = [
            'new' => Ticket::where('status', TicketStatus::New)->count(),
            'open' => Ticket::where('status', TicketStatus::Open)->count(),
            'responded' => Ticket::where('status', TicketStatus::Responded)->count(),
        ];

        return view('admin.tickets.index', compact('tickets', 'stats'));
    }

    public function create(): View
    {
        $questions = Question::latest('id')->get();
        return view('admin.tickets.create', compact('questions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question_id' => ['nullable', 'integer', 'exists:questions,id'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'requester_name' => ['required', 'string', 'max:255'],
            'requester_email' => ['required', 'email', 'max:255'],
            'requester_phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:new,open,responded'],
            'priority' => ['required', 'in:low,normal,high'],
            'channel' => ['required', 'string', 'max:50'],
        ]);

        $validated['ticket_number'] = TicketNumberHelper::generate();

        Ticket::create($validated);

        return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'success', 'message' => 'Ticket created successfully.']);
    }

    public function show(Ticket $ticket): View
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket): View
    {
        $questions = Question::latest('id')->get();
        return view('admin.tickets.edit', compact('ticket', 'questions'));
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $validated = $request->validate([
            'question_id' => ['nullable', 'integer', 'exists:questions,id'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'requester_name' => ['required', 'string', 'max:255'],
            'requester_email' => ['required', 'email', 'max:255'],
            'requester_phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:new,open,responded'],
            'priority' => ['required', 'in:low,normal,high'],
            'channel' => ['required', 'string', 'max:50'],
            'response_message' => ['nullable', 'string'],
        ]);

        if (! empty($validated['response_message']) && $ticket->responded_at === null) {
            $validated['responded_at'] = now();
        }

        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'success', 'message' => 'Ticket updated successfully.']);
    }

    public function destroy(Ticket $ticket): RedirectResponse
    {
        $ticket->delete();

        return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'success', 'message' => 'Ticket deleted successfully.']);
    }
}
