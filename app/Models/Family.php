<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    //
    protected $table = "families";
    protected $fillable = ['name', 'code'];

    public function users(){
        return $this->hasMany(User::class);
    }
}