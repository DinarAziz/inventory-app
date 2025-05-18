<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Loan;

class CheckOverdueLoans
{
    public function handle(Request $request, Closure $next)
    {
        Loan::where('status', 'approved')
            ->whereDate('due_date', '<', now())
            ->update(['status' => 'overdue']);

        return $next($request);
    }
}
