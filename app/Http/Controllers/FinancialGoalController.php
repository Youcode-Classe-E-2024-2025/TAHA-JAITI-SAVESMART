<?php

namespace App\Http\Controllers;

use App\Models\FinancialGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialGoalController extends Controller
{
    public function index(){
        $financialGoals = FinancialGoal::paginate(10);

        return view('goal.index', compact('financialGoals'));
    }

    public function create(){
        return view('goal.create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'string|min:3|max:255',
            'target' => 'required|numeric',
            'current_amount' => 'required|numeric',
            'deadline' => 'required|date',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $cover = $request->hasFile('cover') ? $request->file('cover')->store('covers', 'public') : null;


        $goal = FinancialGoal::create([
            'name' => $request->name,
            'description'=> $request->description,
            'target' => $request->target,
            'current_amount' => $request->current_amount,
            'deadline' => $request->deadline,
            'cover' => $cover,
            'user_id' => Auth::user()->id,
            'family_id' => $request->type === 'personal' ? null : Auth::user()->family_id,
        ]);

        if ($goal) {

            return to_route('goal.index')->with('success', 'Goal created successfully');
        }

        return to_route('goal.index')->with('error','Failed to create financial goal');
    }
}
