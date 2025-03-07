<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\FinancialGoal;
use App\Services\BudgetOptService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'type' => 'required|in:needs,wants,savings',
            'current_amount' => 'required|numeric',
            'deadline' => 'required|date',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $cover = $request->hasFile('cover') ? $request->file('cover')->store('covers', 'public') : null;


        $goal = FinancialGoal::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
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
        $opt = BudgetOptService::optimize(Auth::id(), $goal);
        return view('goal.show', compact(['goal', 'opt']));
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

    public function update(Request $request, FinancialGoal $goal){
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|min:3|max:255',
            'target' => 'required|numeric|min:0',
            'type' => 'in:needs,wants,savings',
            'current_amount' => 'nullable|numeric|min:0',
            'deadline' => 'required|date',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_family' => 'nullable|boolean'
        ]);

        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'target' => $request->target,
            'current_amount' => $request->current_amount ?? 0,
            'deadline' => $request->deadline,
        ];

        if ($request->hasFile('cover')) {
            if ($goal->cover_image && Storage::disk('public')->exists($goal->cover_image)) {
                Storage::disk('public')->delete($goal->cover_image);
            }

            $updateData['cover_image'] = $request->file('cover')->store('covers', 'public');
        }

        if ($user->family_id) {
            $updateData['is_family'] = $request->has('is_family');
        }

        if ($request->target > $request->current_amount){
            $updateData['status'] = 'active';
        }

        $updated = $goal->update($updateData);

        if ($updated) {
            return to_route('goal.index')->with('success', 'Goal updated successfully');
        }

        return to_route('goal.index')->with('error', 'Failed to update financial goal');
    }

    public function deposit(FinancialGoal $goal){
        $user = Auth::user();

        if ($goal->user_id != $user->id) {
            return back()->with('error', 'You are not authorized to deposit to this goal');
        }

        $amount = BudgetOptService::optimize(Auth::id(), $goal);

        $remaining = $goal->target - $goal->current_amount;

        if ($remaining < $amount) {
            $amount = $remaining;
        }

        $goal->current_amount += $amount;
        $goal->save();

        if ($goal->current_amount >= $goal->target){
            $goal->status = 'done';
            $goal->save();
        }

        $category = Category::firstOrCreate([
            'name' => ucfirst($goal->type),
            'user_id' => $user->id,
        ]);


        $transaction = Transaction::create([
            'name' => "Deposit to {$goal->name}",
            'amount' => $amount,
            'transaction_date' => now(),
            'type' => 'expense',
            'category_id' => $category->id,
            'user_id' => $user->id,
            "family_id" => $goal->is_family ? $user->family_id : null,
        ]);

        if ($transaction) {
            return back()->with('success', 'Deposit successful');
        }

        return back()->with('error', 'Failed to deposit to goal');
    }
}