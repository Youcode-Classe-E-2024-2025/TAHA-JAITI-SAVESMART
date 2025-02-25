<?php

namespace App\Http\Controllers;

use App\Models\FinancialGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = FinancialGoal::query();

        if ($user->family_id) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('family_id', $user->family_id);
            });
        } else {
            $query->where('user_id', $user->id);
        }

        if ($request->name && $request->name !== '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->start_date && $request->start_date !== '') {
            $query->whereDate('start_date', $request->start_date);
        }

        if ($request->end_date && $request->end_date !== '') {
            $query->whereDate('end_date', $request->end_date);
        }

        $financialGoals = $query->paginate(6);

        return view('financial_goal.index', compact('financialGoals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financial_goal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();

        $validatedData['user_id'] = $user->id;
        if ($user->family_id) {
            $validatedData['family_id'] = $user->family_id;
        }

        FinancialGoal::create($validatedData);

        return redirect()->route('financial_goals.index')->with('success', 'Financial goal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialGoal $financialGoal)
    {

        return view('financial_goal.show', compact('financialGoal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialGoal $financialGoal)
    {
        return view('financial_goal.edit', compact('financialGoal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialGoal $financialGoal)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $financialGoal->update($validatedData);

        return redirect()->route('financial_goals.index')->with('success', 'Financial goal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialGoal $financialGoal)
    {
        $financialGoal->delete();

        return redirect()->route('financial_goals.index')->with('success', 'Financial goal deleted successfully.');
    }
}
