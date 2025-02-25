<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
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
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
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
