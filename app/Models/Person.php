<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name','address','dpi', 'phone_number','email','state'];


    public function employee(){
        return $this->hasOne(Employee::class);
    }

}
