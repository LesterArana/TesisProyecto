<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['person_id'];


    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function credits(){
        return $this->hasMany(Credit::class);
    }

    public function shoppings(){
        return $this->hasMany(Shopping::class);
    }
}
