<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable=["name"];


    public function credits(){
        return $this->hasMany(Credit::class);
    }
    public function customerPayments(){
        return $this->hasMany(CustomerPayment::class);
    }
}
