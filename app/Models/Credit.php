<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = ['voucher_number','date','mount','status','supplier_id','bank_account_id','payment_method_id'];

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function bankaccount(){
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }
    public function paymentmethod(){
        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }

    public function imageable(){
        return $this->morphOne(Image::class,'imageable');
    }
}
