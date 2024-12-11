<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;
    protected $fillable=['voucher_number','date','total','status','payment_method_id','customer_id','bank_account_id'];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function sales(){
        return $this->belongsToMany(Sale::class, 'customer_payment_sale', 'customer_payment_id', 'sale_id')
            ->withPivot('amount');
    }

    public function bankAccount(){
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }
    public function imageable(){
        return $this->morphOne(Image::class,'imageable');
    }
}
