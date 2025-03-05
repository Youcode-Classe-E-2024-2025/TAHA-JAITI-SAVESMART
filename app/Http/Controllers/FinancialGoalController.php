<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FinancialGoal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialGoalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = FinancialGoal::query();

        if ($user->family_id) {
            $query->where('family_id', $user->family_id);
            $query->orWhere('user_id', $user->id);
        } else {
            $query->where('user_id', $user->id);
        }

        $financialGoals =$query->orderBy('created_at','desc')->paginate(10);

        FinancialGoal::whereColumn('current_amount', 'target')
        ->update(['status' => 'done']);

        return view('goal.index', compact('financialGoals'));
    }

    public function create()
    {
        return view('goal.create');
    }

    public function store(Request $request)
    {

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
            'description' => $request->description,
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

        return to_route('goal.index')->with('error', 'Failed to create financial goal');
    }

    public function show(FinancialGoal $goal)
    {
        $user = Auth::user();

        $query = Category::query();

        if ($user->family_id) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('family_id', $user->family_id);
            });
        } else {
            $query->where('user_id', $user->id);
        }

        $categories = $query->get();


        return view('goal.show', compact(['goal', 'categories']));
    }

    public function destroy(FinancialGoal $goal)
    {
        $user = Auth::user();

        if ($goal->user_id != $user->id) {
            return back()->with('error', 'You are not authorized to delete this goal');
        }

        $goal->delete();

        return to_route('goal.index')->with('success', 'Goal deleted successfully');
    }

    public function edit(FinancialGoal $goal){
        return view('goal.edit', compact('goal'));
    }

    public function deposit(Request $request ,FinancialGoal $goal){
        $user = Auth::user();

        if ($goal->user_id != $user->id) {
            return back()->with('error', 'You are not authorized to deposit to this goal');
        }

        $request->validate([
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $amount = $request->amount;

        if ($request->amount > $goal->target){
            $amount = $goal->target - $goal->current_amount;
        }

        $goal->current_amount += $amount;
        $goal->save();


        $transaction = Transaction::create([
            'name' => "Deposit to {$goal->name}",
            'amount' => $amount,
            'transaction_date' => now(),
            'type' => 'expense',
            'category_id' => $request->category_id,
            'user_id' => $user->id,
            "family_id" => $request->is_family ? $user->family_id : null,
        ]);

        if ($transaction) {
            return back()->with('success', 'Deposit successful');
        }

        return back()->with('error', 'Failed to deposit to goal');
    }
}