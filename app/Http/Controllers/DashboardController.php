<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\FinancialGoal;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index(){
        $user = Auth::user();

        $date = Carbon::now();

        $transactions = Transaction::where('user_id', $user->id)->whereMonth('created_at', $date->month)
        ->whereYear('created_at', $date->year)->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpenses = $transactions->where('type', 'expense')->sum('amount');

        $availableBalance = $totalIncome - $totalExpenses;

        $savingGoals = FinancialGoal::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        $recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();


        return view('index', [
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'availableBalance' => $availableBalance,
            'savingsGoals' => $savingGoals,
            'recentTransactions'=> $recentTransactions,
        ]);
    }

}