<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{

    public function create() {
        return view('income.create');
    }

    public function store(Request $request) {
        $request->validate([
            'amount' => 'required|numeric',
            'source' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date_received' => 'nullable|date',
        ]);

        $income = Income::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'source' => $request->source,
            'type' => $request->type,
            'date_received' => $request->date_received,
            'family_id' => Auth::user()->family_id,
        ]);

        Auth::user()->balance += $request->amount;

        Auth::user()->save();

        return to_route('dashboard');
    }


}
