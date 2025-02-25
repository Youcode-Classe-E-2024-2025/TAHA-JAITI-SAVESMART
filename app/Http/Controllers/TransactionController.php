<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'source' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date_received' => 'nullable|date',
        ]);

        $transaction = Transaction::create([
           'user_id' => auth()->id(),
           'amount' => $request->amount,
           'source' => $request->source,
           'frequency' => $request->frequency,
           'type' => $request->type,
           'date_received' => $request->date_received,
           'family_id' => auth()->user()->family_id,
        ]);

        Auth::user()->balance += $request->amount;
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
