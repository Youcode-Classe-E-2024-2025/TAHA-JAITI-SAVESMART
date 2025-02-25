<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    //

    protected $fillable = [
        'user_id',
        'family_id',
        'amount',
        'source',
        'type',
        'date_received',
    ];

    public function family(){
        return $this->belongsTo(Family::class, 'family_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
