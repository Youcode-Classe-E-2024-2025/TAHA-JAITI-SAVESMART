<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\FinancialGoal;

class BudgetOptService {


    public static function calculate(int $balance, int $total_goals, string $type){

    $balance = $balance === 0 ? 1 : $balance;
    $total_goals = $total_goals === 0 ? 1 : $total_goals;

        $budget = $balance / $total_goals;

        switch ($type) {
            case 'needs':
                return $budget * 0.5;
            case 'wants':
                return $budget * 0.3;
            case 'savings':
                return $budget * 0.2;
        }
    }

    public static function optimize (int $userId, FinancialGoal $goal) {
        $balance = Transaction::getBalence($userId);
        $count = Transaction::where('user_id', $userId)->count();

        $opt = $balance === 0 ? 0 : self::calculate($balance, $count, $goal->type);
        return number_format($opt, 2);
    }

}