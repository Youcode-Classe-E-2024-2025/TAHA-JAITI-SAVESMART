<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialGoal extends Model
{
    //

    protected $fillable = [
        'name',
        'description',
        'cover',
        'status',
        'target',
        'current_amount',
        'deadline',
        'user_id',
        'family_id',
    ];

    protected $cast = [
        'deadline' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function family(){
        return $this->belongsTo(Family::class);
    }

    public function financialGoal(){
        return $this->hasMany(FinancialGoal::class);
    }
}
