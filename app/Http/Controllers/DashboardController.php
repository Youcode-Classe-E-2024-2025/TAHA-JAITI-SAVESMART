<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        return view('dash.index');
    }

    public function transactions(Request $request){
        $user = Auth::user();
        $categories = [];

        if ($user->family_id) {
            $categories = Category::where('family_id', $user->family_id)->get();
        } else {
            $categories = Category::where('user_id', $user->id)->get();
        }

        $query = Transaction::query();

        if ($user->family_id) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('family_id', $user->family_id);
            });
        } else {
            $query->where('user_id', $user->id);
        }

        // Filters
        if ($request->category_id && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->type && $request->type !== '') {
            $query->where('type', $request->type);
        }

        if ($request->date && $request->date !== '') {
            $query->whereDate('date', $request->date);
        }

        $transactions = $query->paginate(10);

        return view('dash.transactions', compact('categories', 'transactions'));
    }
}
