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
        'category_id',
        'type',
        'frequency',
        'date_received',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
