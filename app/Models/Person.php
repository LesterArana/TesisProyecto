<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['type_person','company_name','address','email', 'phone_number','nit_number','state'];

  
    public function supplier(){
        return $this->hasOne(Supplier::class);
    }

    public function customer(){
        return $this->hasOne(Customer::class);
    }


}
