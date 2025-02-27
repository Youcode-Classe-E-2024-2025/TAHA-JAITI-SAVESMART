<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::orderBy("created_at","desc")->paginate(10);

        return view("transaction.index",compact("transactions"));
    }
}
