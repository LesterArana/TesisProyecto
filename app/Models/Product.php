<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'stock', 'description', 'status', 'category_id'];


    public function shopings(){
        return $this->belongsToMany(Shopping::class)->withTimestamps()->withPivot('amount','price_shopping','price_sale');
    }

    public function sales(){
        return $this->belongsToMany(Sale::class)->withTimestamps()->withPivot('amount','price_sale');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function imageable(){
        return $this->morphOne(Image::class,'imageable');
    }
}
