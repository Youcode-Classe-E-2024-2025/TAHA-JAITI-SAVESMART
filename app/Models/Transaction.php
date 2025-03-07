<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'name',
        'amount',
        'transaction_date',
        'type',
        'category_id',
        'user_id',
        'family_id',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public static function getBalence(int $id){
        $income = Transaction::where('user_id', $id)->where('type', 'income')->sum('amount');
        $expense = Transaction::where('user_id', $id)->where('type', 'expense')->sum('amount');

        return $income - $expense;
    }
}