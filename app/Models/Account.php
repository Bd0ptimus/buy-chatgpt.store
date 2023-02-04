<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
class Account extends Model
{
    protected $table="accounts";
    protected $fillable=[
        'account',
        'password',
        'product_id',
        'sold',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id', 'id');
    }
}
