<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    // Store a new ticket
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket = Ticket::create($validated);

        return new TicketResource($ticket);
    }

    // Update the ticket status
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update($validated);

        return new TicketResource($ticket);
    }

    // List all tickets
    public function index()
    {
        $tickets = Ticket::all();
        return TicketResource::collection($tickets);
    }

    // Show details of a specific ticket
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return new TicketResource($ticket);
    }
}
