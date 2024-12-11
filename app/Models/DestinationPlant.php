<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationPlant extends Model
{
    use HasFactory;

    protected $fillable=['name','address','phone_number','status','customer_id','country_id'];


    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

}
