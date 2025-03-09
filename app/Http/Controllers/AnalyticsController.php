<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Ticket;
use App\Models\CustomerActivity;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    // Revenue Analytics (Total Revenue)
    public function revenueAnalytics(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        $revenue = Invoice::where('status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        return response()->json(['total_revenue' => $revenue]);
    }

    // Ticket Analytics (Average Resolution Time)
    public function ticketAnalytics()
    {
        $averageResolutionTime = Ticket::where('status', 'resolved')
            ->avg(\DB::raw('TIMESTAMPDIFF(HOUR, created_at, updated_at)'));

        return response()->json(['average_resolution_time' => $averageResolutionTime]);
    }

    // Customer Analytics (Activity Count)
    
}

