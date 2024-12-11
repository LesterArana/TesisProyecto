<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['person_id'];

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function customerPayments(){
        return $this->hasMany(CustomerPayment::class);
    }
    public function destinationPlants(){
        return $this->hasMany(DestinationPlant::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }

}
