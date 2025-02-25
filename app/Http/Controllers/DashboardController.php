<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        return view('dash.index',);
    }

    public function transactions(){
        $transactions = auth()->user()->transactions()->latest()->get()->sortBy('created_at');

        return view('dash.transactions', compact('transactions'));
    }
}
