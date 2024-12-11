<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable=['purchase_order','date_hour','total_price','bill_number','liquidity_status','credit_days','destination','status','shipment_id','customer_id','user_id'];

    public function shipment(){
        return $this->belongsTo(Shipment::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function customerPayments(){
        return $this->belongsToMany(CustomerPayment::class)->withTimestamps()->withPivot('amount');
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('amount','price_sale');
    }
}
