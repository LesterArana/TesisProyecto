<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $fillable=['bill_number','date_hour','total_price','status','shipment_id','shopping_type_id','supplier_id'];
    use HasFactory;

    public function shipment(){
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
    public function shoppingType(){
        return $this->belongsTo(ShoppingType::class, 'shopping_type_id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('amount','price_shopping','price_sale');
    }

}
