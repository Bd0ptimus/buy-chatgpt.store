<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Checkout;

class Account extends Model
{
    protected $table="accounts";
    protected $fillable=[
        'account',
        'password',
        'product_id',
        'sold',
        'checkout_complete_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id', 'id');
    }

    public function checkouts(){
        return $this->belongsTo(Checkout::class,'checkout_complete_id', 'id');
    }

}
