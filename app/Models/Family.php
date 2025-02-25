<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    //
    protected $fillable = [
        'name',
        'owner_id',
        'code',
    ];

    public function category(){
        return $this->hasMany(Category::class);
    }
}
