<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        $query = Transaction::query();

        $viewMode = $request->input('view_mode', 'personal');
        if ($user->family_id) {
            switch ($viewMode) {
                case 'personal':
                    $query->where('user_id', $user->id)->whereNull('family_id');
                    break;
                case 'family':
                    $query->where('family_id', $user->family_id);
                    break;
                case 'all':
                    $query->where('user_id', $user->id)
                        ->orWhere('family_id', $user->family_id);
                    break;
                default;
                    break;
            }
        } else {
            $query->where('user_id', $user->id);
        }


        $dateRange = $request->input('date_range', 'all');
        switch ($dateRange) {
            case 'today':
                $query->whereDate('transaction_date', today());
                break;
            case 'week':
                $query->whereBetween('transaction_date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereBetween('transaction_date', [now()->startOfMonth(), now()->endOfMonth()]);
                break;
            case 'year':
                $query->whereBetween('transaction_date', [now()->startOfYear(), now()->endOfYear()]);
                break;
            default:
                break;
        }


        $transactions = $query->with(['category', 'user'])
            ->orderBy('transaction_date', 'desc')->paginate(10);

        return view("transaction.index", compact("transactions"));
    }

    public function create()
    {
        $user = Auth::user();

        $categories = Category::where("user_id", $user->id)->orWhere("family_id", $user->family_id)->get();

        return view("transaction.create", compact("categories"));
    }

    public function store(Request $request)
    {

        $request->validate([
            "name" => "required|string|min:3|max:255",
            "amount" => "required|numeric",
            "transaction_date" => "required|date",
            "type" => "required|in:expense,income",
            "category_id" => "required|exists:categories,id",
            "is_family" => "boolean",
        ]);

        $transaction = Transaction::create([
            "name" => $request->name,
            "amount" => $request->amount,
            "transaction_date" => $request->transaction_date,
            "type" => $request->type,
            "category_id" => $request->category_id,
            "user_id" => Auth::user()->id,
            "family_id" => $request->is_family ? Auth::user()->family_id : null,
        ]);

        if ($transaction) {
            return to_route('transaction.index')->with('success', 'Transaction created successfully');
        }

        return back()->with('error', 'Transaction could not be created, try again');
    }
}
