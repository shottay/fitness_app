<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Auth::user()->expenses()->with('category')->latest()->get();
        return view('bookkeeping.index', compact('expenses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:book_categories,id',
            'date' => 'required|date',
            'description' => 'required|string|max:255'
        ]);

        $expense = Auth::user()->expenses()->create($validated);

        return redirect()->route('bookkeeping.index')
            ->with('success', 'Ausgabe wurde erfolgreich erstellt.');
    }
}