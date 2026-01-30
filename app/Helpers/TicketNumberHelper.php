<?php

namespace App\Helpers;

use App\Models\Ticket;
use Carbon\Carbon;

class TicketNumberHelper
{
    public static function generate(): string
    {
        $date = Carbon::now()->format('Ymd');
        $prefix = "PIP-{$date}-";

        $lastTicket = Ticket::where('ticket_number', 'like', $prefix . '%')
            ->orderByDesc('ticket_number')
            ->first();

        $nextNumber = 1;

        if ($lastTicket) {
            $lastSequence = (int) substr($lastTicket->ticket_number, strlen($prefix));
            $nextNumber = $lastSequence + 1;
        }

        $sequence = str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);

        return $prefix . $sequence;
    }
}