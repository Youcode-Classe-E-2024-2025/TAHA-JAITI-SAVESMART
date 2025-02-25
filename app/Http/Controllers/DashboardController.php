<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){


        return view('dash.index',);
    }

    public function transactions(){
        $incomes = auth()->user()->transactions()->latest()->get();

        return view('dash.transactions', compact('incomes'));
    }
}
