<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoanController extends Controller
{
    public function history()
    {
        $loans = Loan::with('item')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('loan.history', compact('loans'));
    }

    public function create()
    {
        $items = Item::where('stock', '>', 0)->get();
        return view('loan.form', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'item_id' => 'required|exists:items,id',
    'quantity' => 'required|integer|min:1',
    'due_date' => ['required', 'date', 'after:today', function ($attribute, $value, $fail) {
        $maxDays = 7;
        $borrowDate = now()->startOfDay();
        $dueDate = \Carbon\Carbon::parse($value)->startOfDay();

        if ($borrowDate->diffInDays($dueDate, false) > $maxDays) {
            $fail('Maksimal peminjaman hanya 7 hari dari hari ini.');
        }
    }],
]);

        $item = Item::findOrFail($request->item_id);

        if ($request->quantity > $item->stock) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi.'])->withInput();
        }

        Loan::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'borrow_date' => now(),
            'due_date' => $request->due_date,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);

        return redirect()->route('loan.create')->with('success', 'Permintaan peminjaman berhasil diajukan.');
    }
}
