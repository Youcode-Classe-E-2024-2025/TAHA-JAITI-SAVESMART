<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $currentBalance = auth()->user()->balance;
        $latestBalance = auth()->user()->incomes()->latest('created_at')->first()->amount;

        if ($latestBalance){
            $previous = $currentBalance - $latestBalance;

            $percentage = $previous > 0 ? round(($latestBalance / $previous) * 100, 2) : 0;
        } else {
            $percentage = 0;
        }

        $monthlyIncome = auth()->user()->incomes()
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        return view('dash.index', compact('currentBalance', 'percentage', 'monthlyIncome'));
    }

    public function transactions(){
        return view('dash.transactions');
    }
}
