<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable=['name','postal_code'];
    public function destinationPlants(){
        return $this->hasMany(DestinationPlant::class);
    }
}
