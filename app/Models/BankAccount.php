<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = ['name_bank', 'account_number'];

    public function credits(){
        return $this->hasMany(Credit::class);
    }

    public function customerPayments(){
        return $this->hasMany(CustomerPayment::class);
    }
}
