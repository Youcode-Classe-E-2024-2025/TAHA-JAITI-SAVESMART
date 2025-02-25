<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'user_id',
        'family_id',
        'amount',
        'source',
        'type',
        'frequency',
        'date_received',
    ];
}
