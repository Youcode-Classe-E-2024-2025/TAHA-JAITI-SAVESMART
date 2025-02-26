<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialGoal extends Model
{

    protected $fillable = [
        'user_id',
        'family_id',
        'name',
        'target_amount',
        'start_date',
        
        'end_date',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
