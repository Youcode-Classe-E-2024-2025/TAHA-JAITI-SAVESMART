<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function index(Request $request){
        $user = Auth::user();
        $categories = [];

        if ($user->family_id) {
            $categories = Category::where('family_id', $user->family_id)->get();
        } else {
            $categories = Category::where('user_id', $user->id)->get();
        }

        $query = Transaction::query();

        if ($user->family_id) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('family_id', $user->family_id);
            });
        } else {
            $query->where('user_id', $user->id);
        }

        // Filters
        if ($request->category_id && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->type && $request->type !== '') {
            $query->where('type', $request->type);
        }

        if ($request->date && $request->date !== '') {
            $query->whereDate('date', $request->date);
        }

        $transactions = $query->paginate(10);

        return view('dash.transactions', compact('categories', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        $categories = [];

        if ($user->family_id){
            $categories = Category::where('family_id', $user->family_id)->get() ?? [];
        } else {
            $categories = Category::where('user_id', $user->id)->get() ?? [];
        }

        return view('transaction.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'category_id' => 'integer|exists:categories,id',
            'frequency' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date_received' => 'nullable|date',
        ]);

        $transaction = Transaction::create([
           'user_id' => auth()->id(),
           'amount' => $request->amount,
           'category_id' => $request->get('category_id'),
           'frequency' => $request->frequency,
           'type' => $request->type,
           'date_received' => $request->date_received,
           'family_id' => auth()->user()->family_id,
        ]);

        $transaction->type === 'income' ? Auth::user()->balance += $transaction->amount : Auth::user()->balance -= $transaction->amount;
        Auth::user()->save();

        return to_route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $user = Auth::user();
        $categories = [];

        if ($user->family_id) {
            $categories = Category::where('family_id', $user->family_id)->get();
        } else {
            $categories = Category::where('user_id', $user->id)->get();
        }

        if ($transaction->user_id !== $user->id && $transaction->family_id !== $user->family_id) {
            abort(403, 'Unauthorized.');
        }

        return view('transaction.edit', compact('categories', 'transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'date_received' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'frequency' => 'required|in:monthly,weekly,daily,one-time',
            'type' => 'required|in:income,expense',
        ]);

        $transaction->update($validatedData);

        return redirect()->route('dashboard.transactions')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return back();
    }
}
