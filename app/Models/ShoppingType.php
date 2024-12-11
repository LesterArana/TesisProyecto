<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingType extends Model
{
    use HasFactory;

    public function shoppings(){
        return $this->hasMany(Shopping::class);
    }
}
