<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'family_id',
        'user_id'
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

    public function family(){
        return $this->belongsTo(Family::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
