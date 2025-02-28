<?php

namespace App\Http\Controllers;

use App\Models\FinancialGoal;
use Illuminate\Http\Request;

class FinancialGoalController extends Controller
{
    public function index(){
        $financialGoals = FinancialGoal::paginate(10);

        return view('goal.index', compact('financialGoals'));
    }

    public function create(){
        return view('goal.create');
    }
}
