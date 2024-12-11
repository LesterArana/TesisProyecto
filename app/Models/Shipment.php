<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable=['number_shipment','status','shipment_type_id'];
    use HasFactory;

    public function shopping(){
        return $this->hasOne(Shopping::class);
    }
    public function sale(){
        return $this->hasOne(Sale::class);
    }

    public function shipmentType()
    {
        return $this->belongsTo(ShipmentType::class);
    }

    public function imageable(){
        return $this->morphOne(Image::class,'imageable');
    }

}
